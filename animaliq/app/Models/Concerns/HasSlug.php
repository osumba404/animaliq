<?php

namespace App\Models\Concerns;

use Illuminate\Support\Str;

trait HasSlug
{
    public static function bootHasSlug(): void
    {
        static::saving(function (self $model) {
            $source = $model->getSlugSource();
            if (blank($source)) {
                return;
            }
            $slug = $model->slug ?? Str::slug($source);
            if (blank($slug)) {
                $slug = Str::slug(Str::limit($source, 50));
            }
            $model->slug = static::makeSlugUnique($model, $slug);
        });
    }

    protected function getSlugSource(): ?string
    {
        return $this->title ?? $this->name ?? null;
    }

    protected static function makeSlugUnique(self $model, string $slug): string
    {
        $base = $slug;
        $i = 1;
        while (true) {
            $query = static::query()->where('slug', $slug);
            if ($model->exists) {
                $query->where($model->getKeyName(), '!=', $model->getKey());
            }
            if (! $query->exists()) {
                break;
            }
            $slug = $base . '-' . (++$i);
        }
        return $slug;
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        $field = $field ?? $this->getRouteKeyName();
        if (is_numeric($value)) {
            return static::query()->where('id', $value)->first();
        }
        return static::query()->where($field, $value)->first();
    }
}
