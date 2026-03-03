# Admin and Super Admin Access

Admin access is controlled by the **`role`** column on the **users** table: `member`, `admin`, or `super_admin`.

## Super Admin vs Admin

- **Super Admin**  
  - Can access **everything** in the admin panel (Dashboard, Departments, Programs, Events, Research, Campaigns, Posts, Settings, Team, Donations, Products, Users, Audit Log).  
  - Only super admins can manage **Departments**, **Users**, and **Audit Log**.

- **Admin**  
  - Must be a **member of at least one department** that has **admin sections** assigned.  
  - Can only see and edit the admin menu sections that are enabled for their department(s).  
  - If an admin is not in any department, or their departments have no admin sections, they get: *"You must be assigned to a department with admin access."*

## Making someone Super Admin or Admin

**Option A – From the admin panel**

1. Log in as a **super_admin**.
2. Go to **Admin → Users**.
3. Edit the user and set **Role** to **Admin** or **Super Admin**, then save.

**Option B – Command line**

```bash
# Make admin
php artisan animaliq:make-admin their@email.com

# Make super admin
php artisan animaliq:make-admin their@email.com --super
```

## Giving an admin access to specific areas

1. Log in as **super_admin**.
2. Go to **Admin → Departments**.
3. **Create** or **Edit** a department.
4. In **Admin sections**, check the areas that members of this department are allowed to see and edit (e.g. Programs, Events, Research, Campaigns, Posts, Settings, Team, Donations, Products).  
   Dashboard is always available to any admin who has at least one section.
5. Save the department.
6. In the same department’s **Edit** page, under **Department members**, click **Add member**, choose the user (e.g. the admin you created), optionally set position and Lead, then **Add member**.

That user (with role **admin**) will now only see and use the admin menu sections you selected for that department. To give them more areas, add them to another department that has those sections, or edit the department and add more admin sections.

## Summary

| Role         | Departments / Users / Audit | Other admin sections        |
|-------------|-----------------------------|-----------------------------|
| **super_admin** | ✅ Full access              | ✅ Full access              |
| **admin**       | ❌ No access                | ✅ Only those of their department(s) |
