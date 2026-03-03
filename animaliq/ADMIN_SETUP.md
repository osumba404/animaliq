# Creating Admin and Super Admin Users

Admin access is controlled by the **`role`** column on the **users** table: `member`, `admin`, or `super_admin`. No seeding required.

## 1. Run the migration (once)

```bash
php artisan migrate
```

This adds the `role` column (default `member`) to `users`.

## 2. Make someone admin

**Option A – From the admin panel (easiest)**

1. Log in as a user who is already **admin** or **super_admin** (or use Option B first to make yourself one).
2. Go to **Admin → Users** (`/admin/users`).
3. Click **Edit** on the user.
4. Set **Role** to **Admin** or **Super Admin**.
5. Save.

**Option B – From the command line**

After the user has registered (or been created), run:

```bash
# Make admin
php artisan animaliq:make-admin their@email.com

# Make super admin
php artisan animaliq:make-admin their@email.com --super
```

Both **admin** and **super_admin** can access `/admin`. Use **super_admin** for the top-level account(s) if you later add role-specific permissions.
