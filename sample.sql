-- ============================================
-- COMPREHENSIVE DATABASE POPULATION FOR ANIMALIQ
-- COMPLETE FIXED VERSION - NO EXPLICIT IDS
-- ============================================

-- Disable foreign key checks for bulk insert
SET FOREIGN_KEY_CHECKS = 0;
START TRANSACTION;

-- ============================================
-- 1. ROLES (Extended Role Definitions)
-- ============================================
INSERT INTO `roles` (`name`, `description`) VALUES
('super_admin', 'Full system access. Can manage all content, users, and settings.'),
('admin', 'Administrator. Can manage content and users within assigned scope.'),
('editor', 'Content editor. Can create and edit posts, events, and research.'),
('member', 'Registered member. Can register for events and volunteer.'),
('researcher', 'Research team member. Can manage research projects.'),
('volunteer_coordinator', 'Manages volunteers and their hours.'),
('finance_manager', 'Manages donations and financial records.');

-- ============================================
-- 2. PERMISSIONS (Detailed Permission System)
-- ============================================
INSERT INTO `permissions` (`name`) VALUES
('view_dashboard'),
('manage_users'),
('manage_roles'),
('manage_permissions'),
('create_content'),
('edit_content'),
('delete_content'),
('publish_content'),
('manage_events'),
('manage_research'),
('manage_donations'),
('view_reports'),
('manage_volunteers'),
('manage_departments'),
('manage_media_library'),
('manage_site_settings'),
('view_audit_logs'),
('manage_products'),
('manage_orders'),
('manage_memberships');

-- ============================================
-- 3. ROLE-PERMISSION ASSIGNMENTS
-- (Using subqueries to get correct IDs)
-- ============================================
INSERT INTO `permission_role` (`role_id`, `permission_id`)
SELECT r.id, p.id
FROM roles r, permissions p
WHERE 
    (r.name = 'super_admin' AND p.name IN ('view_dashboard', 'manage_users', 'manage_roles', 'manage_permissions', 'create_content', 'edit_content', 'delete_content', 'publish_content', 'manage_events', 'manage_research', 'manage_donations', 'view_reports', 'manage_volunteers', 'manage_departments', 'manage_media_library', 'manage_site_settings', 'view_audit_logs', 'manage_products', 'manage_orders', 'manage_memberships'))
    OR
    (r.name = 'admin' AND p.name IN ('view_dashboard', 'manage_users', 'create_content', 'edit_content', 'delete_content', 'publish_content', 'manage_events', 'manage_research', 'manage_donations', 'view_reports', 'manage_volunteers', 'manage_departments', 'manage_media_library', 'manage_products', 'manage_orders', 'manage_memberships'))
    OR
    (r.name = 'editor' AND p.name IN ('view_dashboard', 'create_content', 'edit_content', 'publish_content', 'manage_events', 'manage_research', 'view_reports', 'manage_media_library'))
    OR
    (r.name = 'member' AND p.name IN ('view_dashboard'))
    OR
    (r.name = 'researcher' AND p.name IN ('view_dashboard', 'manage_research', 'view_reports', 'manage_media_library'))
    OR
    (r.name = 'volunteer_coordinator' AND p.name IN ('view_dashboard', 'view_reports', 'manage_volunteers'))
    OR
    (r.name = 'finance_manager' AND p.name IN ('view_dashboard', 'manage_donations', 'view_reports', 'manage_products', 'manage_orders'));

-- ============================================
-- 4. ADD MORE USERS (Keep existing ones, add more)
-- ============================================
INSERT INTO `users` (`first_name`, `last_name`, `phone`, `email`, `email_verified_at`, `password`, `profile_photo`, `bio`, `status`, `role`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Sarah', 'Johnson', '+254712345678', 'sarah.johnson@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5T3Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'sarah-johnson.jpg', 'Wildlife biologist with 10 years experience in conservation education.', 'active', 'admin', NULL, NOW(), NOW(), NULL),
('Michael', 'Mwangi', '+254723456789', 'michael.mwangi@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5TSc.NVfvTs/TdZuUyPt.gNMF0c4W', 'michael-mwangi.jpg', 'Passionate about community conservation and youth education.', 'active', 'researcher', NULL, NOW(), NOW(), NULL),
('Grace', 'Akinyi', '+254734567890', 'grace.akinyi@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'grace-akinyi.jpg', 'Environmental educator and volunteer coordinator.', 'active', 'volunteer_coordinator', NULL, NOW(), NOW(), NULL),
('David', 'Omondi', '+254745678901', 'david.omondi@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'david-omondi.jpg', 'Marine biologist focusing on coastal conservation.', 'active', 'researcher', NULL, NOW(), NOW(), NULL),
('Lucy', 'Wambui', '+254756789012', 'lucy.wambui@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'lucy-wambui.jpg', 'Finance professional with passion for wildlife.', 'active', 'finance_manager', NULL, NOW(), NOW(), NULL),
('James', 'Kipchoge', '+254767890123', 'james.kipchoge@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'james-kipchoge.jpg', 'Community outreach specialist and event organizer.', 'active', 'editor', NULL, NOW(), NOW(), NULL),
('Agnes', 'Njeri', '+254778901234', 'agnes.njeri@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'agnes-njeri.jpg', 'Veterinary doctor and wildlife health researcher.', 'active', 'researcher', NULL, NOW(), NOW(), NULL),
('Peter', 'Odhiambo', '+254789012345', 'peter.odhiambo@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'peter-odhiambo.jpg', 'Conservation photographer and media specialist.', 'active', 'editor', NULL, NOW(), NOW(), NULL),
('Mary', 'Atieno', '+254790123456', 'mary.atieno@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'mary-atieno.jpg', 'Regular member and dedicated volunteer.', 'active', 'member', NULL, NOW(), NOW(), NULL),
('John', 'Kariuki', '+254701234567', 'john.kariuki@animaliq.org', NOW(), '$2y$12$RDkc7xowM6/mecuhf.Uy7OT5Sc.NVfvTs/TdZuUyPt.gNMF0c4W', 'john-kariuki.jpg', 'Student volunteer passionate about bird conservation.', 'active', 'member', NULL, NOW(), NOW(), NULL);

-- ============================================
-- 5. ROLE-USER ASSIGNMENTS
-- (Using actual user IDs - assuming existing users 1-2 and new users 3-12)
-- ============================================
INSERT INTO `role_user` (`user_id`, `role_id`)
SELECT u.id, r.id
FROM users u, roles r
WHERE 
    (u.email = 'osumbaevans21@gmail.com' AND r.name = 'super_admin')
    OR (u.email = 'osumbaevans21@gmail.com' AND r.name = 'super_admin') -- This line seems duplicate, keeping as is
    OR (u.email = 'osumbaevanzz@gmail.com' AND r.name = 'admin')
    OR (u.email = 'sarah.johnson@animaliq.org' AND r.name = 'admin')
    OR (u.email = 'sarah.johnson@animaliq.org' AND r.name = 'researcher')
    OR (u.email = 'michael.mwangi@animaliq.org' AND r.name = 'researcher')
    OR (u.email = 'grace.akinyi@animaliq.org' AND r.name = 'volunteer_coordinator')
    OR (u.email = 'david.omondi@animaliq.org' AND r.name = 'researcher')
    OR (u.email = 'lucy.wambui@animaliq.org' AND r.name = 'finance_manager')
    OR (u.email = 'james.kipchoge@animaliq.org' AND r.name = 'editor')
    OR (u.email = 'agnes.njeri@animaliq.org' AND r.name = 'researcher')
    OR (u.email = 'peter.odhiambo@animaliq.org' AND r.name = 'editor')
    OR (u.email = 'mary.atieno@animaliq.org' AND r.name = 'member')
    OR (u.email = 'john.kariuki@animaliq.org' AND r.name = 'member');

-- ============================================
-- 6. DEPARTMENTS
-- ============================================
INSERT INTO `departments` (`name`, `slug`, `mandate`, `admin_sections`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Innovation and IT', 'innovation-and-it', 'Building and maintaining digital platforms, websites, and technological solutions for conservation.', '["technology","research","team"]', NOW(), NOW(), NULL),
('Education and Research', 'education-and-research', 'Developing educational content, conducting research, and publishing scientific findings.', '["research","team","publications"]', NOW(), NOW(), NULL),
('Community Outreach', 'community-outreach', 'Engaging local communities, organizing events, and promoting conservation awareness.', '["events","team","volunteers"]', NOW(), NOW(), NULL),
('Wildlife Conservation', 'wildlife-conservation', 'Direct wildlife protection, habitat restoration, and conservation initiatives.', '["projects","team","research"]', NOW(), NOW(), NULL),
('Fundraising and Partnerships', 'fundraising-and-partnerships', 'Managing donations, grants, corporate partnerships, and fundraising campaigns.', '["donations","campaigns","partners"]', NOW(), NOW(), NULL),
('Communications and Media', 'communications-and-media', 'Managing public relations, social media, publications, and media outreach.', '["media","posts","team"]', NOW(), NOW(), NULL);

-- ============================================
-- 7. DEPARTMENT MEMBERS
-- ============================================
INSERT INTO `department_members` (`department_id`, `user_id`, `position_title`, `is_lead`, `display_order`, `created_at`, `updated_at`)
SELECT d.id, u.id, 
    CASE 
        WHEN d.name = 'Education and Research' AND u.email = 'osumbaevanzz@gmail.com' THEN 'Department Head - Education'
        WHEN d.name = 'Innovation and IT' AND u.email = 'peter.odhiambo@animaliq.org' THEN 'IT Systems Administrator'
        WHEN d.name = 'Education and Research' AND u.email = 'michael.mwangi@animaliq.org' THEN 'Senior Researcher'
        WHEN d.name = 'Education and Research' AND u.email = 'agnes.njeri@animaliq.org' THEN 'Wildlife Health Specialist'
        WHEN d.name = 'Community Outreach' AND u.email = 'grace.akinyi@animaliq.org' THEN 'Community Outreach Coordinator'
        WHEN d.name = 'Community Outreach' AND u.email = 'james.kipchoge@animaliq.org' THEN 'Events Manager'
        WHEN d.name = 'Community Outreach' AND u.email = 'mary.atieno@animaliq.org' THEN 'Volunteer'
        WHEN d.name = 'Community Outreach' AND u.email = 'john.kariuki@animaliq.org' THEN 'Volunteer'
        WHEN d.name = 'Wildlife Conservation' AND u.email = 'david.omondi@animaliq.org' THEN 'Marine Conservation Lead'
        WHEN d.name = 'Fundraising and Partnerships' AND u.email = 'lucy.wambui@animaliq.org' THEN 'Finance and Partnerships Manager'
        WHEN d.name = 'Communications and Media' AND u.email = 'sarah.johnson@animaliq.org' THEN 'Communications Director'
        WHEN d.name = 'Communications and Media' AND u.email = 'james.kipchoge@animaliq.org' THEN 'Content Creator'
    END as position_title,
    CASE 
        WHEN (d.name = 'Education and Research' AND u.email = 'osumbaevanzz@gmail.com') THEN 1
        WHEN (d.name = 'Community Outreach' AND u.email = 'grace.akinyi@animaliq.org') THEN 1
        WHEN (d.name = 'Wildlife Conservation' AND u.email = 'david.omondi@animaliq.org') THEN 1
        WHEN (d.name = 'Fundraising and Partnerships' AND u.email = 'lucy.wambui@animaliq.org') THEN 1
        WHEN (d.name = 'Communications and Media' AND u.email = 'sarah.johnson@animaliq.org') THEN 1
        ELSE 0
    END as is_lead,
    CASE 
        WHEN (d.name = 'Education and Research' AND u.email = 'osumbaevanzz@gmail.com') THEN 1
        WHEN (d.name = 'Innovation and IT' AND u.email = 'peter.odhiambo@animaliq.org') THEN 2
        WHEN (d.name = 'Education and Research' AND u.email = 'michael.mwangi@animaliq.org') THEN 3
        WHEN (d.name = 'Education and Research' AND u.email = 'agnes.njeri@animaliq.org') THEN 4
        WHEN (d.name = 'Community Outreach' AND u.email = 'grace.akinyi@animaliq.org') THEN 1
        WHEN (d.name = 'Community Outreach' AND u.email = 'james.kipchoge@animaliq.org') THEN 2
        WHEN (d.name = 'Community Outreach' AND u.email = 'mary.atieno@animaliq.org') THEN 5
        WHEN (d.name = 'Community Outreach' AND u.email = 'john.kariuki@animaliq.org') THEN 6
        WHEN (d.name = 'Wildlife Conservation' AND u.email = 'david.omondi@animaliq.org') THEN 1
        WHEN (d.name = 'Fundraising and Partnerships' AND u.email = 'lucy.wambui@animaliq.org') THEN 1
        WHEN (d.name = 'Communications and Media' AND u.email = 'sarah.johnson@animaliq.org') THEN 1
        WHEN (d.name = 'Communications and Media' AND u.email = 'james.kipchoge@animaliq.org') THEN 2
    END as display_order,
    NOW(), NOW()
FROM departments d, users u
WHERE 
    (d.name = 'Education and Research' AND u.email = 'osumbaevanzz@gmail.com') OR
    (d.name = 'Innovation and IT' AND u.email = 'peter.odhiambo@animaliq.org') OR
    (d.name = 'Education and Research' AND u.email = 'michael.mwangi@animaliq.org') OR
    (d.name = 'Education and Research' AND u.email = 'agnes.njeri@animaliq.org') OR
    (d.name = 'Community Outreach' AND u.email = 'grace.akinyi@animaliq.org') OR
    (d.name = 'Community Outreach' AND u.email = 'james.kipchoge@animaliq.org') OR
    (d.name = 'Community Outreach' AND u.email = 'mary.atieno@animaliq.org') OR
    (d.name = 'Community Outreach' AND u.email = 'john.kariuki@animaliq.org') OR
    (d.name = 'Wildlife Conservation' AND u.email = 'david.omondi@animaliq.org') OR
    (d.name = 'Fundraising and Partnerships' AND u.email = 'lucy.wambui@animaliq.org') OR
    (d.name = 'Communications and Media' AND u.email = 'sarah.johnson@animaliq.org') OR
    (d.name = 'Communications and Media' AND u.email = 'james.kipchoge@animaliq.org');

-- ============================================
-- 8. SITE SETTINGS
-- ============================================
INSERT INTO `site_settings` (`setting_key`, `setting_value`, `type`) VALUES
('site_name', 'AnimalIQ - Wildlife & Environmental Education', 'text'),
('mission_statement', 'To educate and inspire communities in wildlife and environmental conservation through innovative programs, research, and community engagement.', 'text'),
('vision_statement', 'A world where people and wildlife thrive together in harmony, supported by educated and empowered communities.', 'text'),
('about_founder_story', 'AnimalIQ was founded in 2015 by a group of passionate conservationists who recognized the urgent need for environmental education in local communities. What started as small workshops in community centers has grown into a comprehensive platform reaching thousands annually.', 'text'),
('core_values', '["Education","Community","Conservation","Integrity","Innovation","Collaboration"]', 'json'),
('homepage_hero_title', 'Welcome to AnimalIQ', 'text'),
('homepage_hero_subtitle', 'Empowering communities through wildlife education and conservation', 'text'),
('homepage_mission_teaser', 'We believe that education is the foundation of conservation. Join us in protecting our natural heritage.', 'text'),
('strategic_plan_file', '/uploads/strategic-plan-2025-2030.pdf', 'text'),
('mission_image', '/uploads/mission-image-2025.jpg', 'text'),
('vision_image', '/uploads/vision-image-2025.jpg', 'text'),
('research_section_banner', '/uploads/research-banner-2025.jpg', 'text'),
('contact_email', 'info@animaliq.org', 'text'),
('contact_phone', '+254 700 123 456', 'text'),
('contact_address', '123 Conservation Lane, Nairobi, Kenya', 'text'),
('social_media', '{"facebook":"https://facebook.com/animaliq","twitter":"https://twitter.com/animaliq","instagram":"https://instagram.com/animaliq","linkedin":"https://linkedin.com/company/animaliq","youtube":"https://youtube.com/animaliq"}', 'json'),
('office_hours', 'Monday-Friday: 9am-5pm, Saturday: 10am-2pm, Sunday: Closed', 'text'),
('annual_reports', '[{"year":2024,"file":"/uploads/annual-report-2024.pdf"},{"year":2023,"file":"/uploads/annual-report-2023.pdf"}]', 'json'),
('impact_stats', '{"members":1500,"volunteers":350,"events":45,"research_projects":12,"donations_raised":250000}', 'json'),
('homepage_video_url', 'https://youtu.be/animaliq-intro', 'text');

-- ============================================
-- 9. HOMEPAGE SLIDES
-- ============================================
INSERT INTO `homepage_slides` (`title`, `subtitle`, `image_path`, `cta_text`, `cta_link`, `cta_secondary_text`, `cta_secondary_link`, `display_order`, `status`, `created_at`, `updated_at`) VALUES
('Welcome to Animal IQ', 'The best place for a conservationist', '/uploads/slides/welcome-slide.jpg', 'Join us', '/about', 'Become a conservationist', '/get-involved', 0, 'active', NOW(), NOW()),
('Upcoming Events', 'Join our community events and workshops', '/uploads/slides/events-slide.jpg', 'View Events', '/events', 'Volunteer', '/volunteer', 1, 'active', NOW(), NOW()),
('Research Matters', 'Explore our latest conservation research', '/uploads/slides/research-slide.jpg', 'Read Research', '/research', 'Support Research', '/donate', 2, 'active', NOW(), NOW()),
('Make a Difference', 'Your support helps protect wildlife', '/uploads/slides/donate-slide.jpg', 'Donate Now', '/donate', 'Learn More', '/about', 3, 'active', NOW(), NOW()),
('Volunteer With Us', 'Join our team of dedicated volunteers', '/uploads/slides/volunteer-slide.jpg', 'Sign Up', '/volunteer', 'View Opportunities', '/volunteer/opportunities', 4, 'active', NOW(), NOW());

-- ============================================
-- 10. TEAM MEMBERS
-- ============================================
INSERT INTO `team_members` (`name`, `image`, `role`, `remarks`, `role_description`, `socials`, `display_order`, `created_at`, `updated_at`) VALUES
('Dr. Sarah Johnson', '/uploads/team/sarah-johnson.jpg', 'Executive Director', 'PhD in Wildlife Conservation', 'Leading AnimalIQ with 15 years experience in conservation and education.', '{"linkedin":"https://linkedin.com/in/sarahjohnson","twitter":"https://twitter.com/sarahj_conservation"}', 1, NOW(), NOW()),
('Michael Mwangi', '/uploads/team/michael-mwangi.jpg', 'Head of Research', 'MSc Conservation Biology', 'Leading research initiatives and community-based conservation projects.', '{"linkedin":"https://linkedin.com/in/michaelmwangi"}', 2, NOW(), NOW()),
('Grace Akinyi', '/uploads/team/grace-akinyi.jpg', 'Volunteer Coordinator', 'Community Development Specialist', 'Managing volunteer programs and community engagement initiatives.', '{"linkedin":"https://linkedin.com/in/graceakinyi"}', 3, NOW(), NOW()),
('Dr. David Omondi', '/uploads/team/david-omondi.jpg', 'Marine Conservation Lead', 'PhD Marine Biology', 'Leading coastal and marine conservation projects.', '{"linkedin":"https://linkedin.com/in/davidomondi"}', 4, NOW(), NOW()),
('Lucy Wambui', '/uploads/team/lucy-wambui.jpg', 'Finance Manager', 'CPA, MBA', 'Managing finances, donations, and grant reporting.', '{"linkedin":"https://linkedin.com/in/lucywambui"}', 5, NOW(), NOW()),
('James Kipchoge', '/uploads/team/james-kipchoge.jpg', 'Events Coordinator', 'Event Management Professional', 'Organizing conservation events and community workshops.', '{"linkedin":"https://linkedin.com/in/jameskipchoge"}', 6, NOW(), NOW()),
('Dr. Agnes Njeri', '/uploads/team/agnes-njeri.jpg', 'Wildlife Veterinarian', 'DVM, MSc Wildlife Health', 'Providing veterinary care and wildlife health research.', '{"linkedin":"https://linkedin.com/in/agnesnjeri"}', 7, NOW(), NOW()),
('Peter Odhiambo', '/uploads/team/peter-odhiambo.jpg', 'Media Specialist', 'Conservation Photographer', 'Capturing conservation stories through photography and video.', '{"instagram":"https://instagram.com/peterwild","linkedin":"https://linkedin.com/in/peterodhiambo"}', 8, NOW(), NOW()),
('Mary Atieno', '/uploads/team/mary-atieno.jpg', 'Community Ambassador', 'Volunteer Leader', 'Leading community outreach and volunteer initiatives.', '{"linkedin":"https://linkedin.com/in/maryatieno"}', 9, NOW(), NOW()),
('John Kariuki', '/uploads/team/john-kariuki.jpg', 'Youth Ambassador', 'Student Conservationist', 'Engaging youth in conservation through school programs.', '{"twitter":"https://twitter.com/johnk_conserve"}', 10, NOW(), NOW());

-- ============================================
-- 11. PROGRAMS
-- ============================================
INSERT INTO `programs` (`title`, `description`, `department_id`, `status`, `created_at`, `updated_at`, `deleted_at`)
SELECT 'School Conservation Education', 'Interactive workshops and field trips for primary and secondary schools to learn about local wildlife and conservation.', d.id, 'active', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Education and Research'
UNION ALL
SELECT 'Community Wildlife Workshops', 'Monthly workshops for community members to learn about coexisting with wildlife and sustainable practices.', d.id, 'active', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Community Outreach'
UNION ALL
SELECT 'Marine Conservation Initiative', 'Protecting coastal ecosystems through research, education, and community engagement.', d.id, 'active', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Wildlife Conservation'
UNION ALL
SELECT 'Youth Conservation Corps', 'Summer program engaging young people in conservation activities and leadership development.', d.id, 'active', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Community Outreach'
UNION ALL
SELECT 'Research Fellowship Program', 'Supporting early-career researchers in conducting conservation research.', d.id, 'active', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Education and Research'
UNION ALL
SELECT 'Corporate Partnerships Program', 'Engaging businesses in sustainable practices and conservation support.', d.id, 'active', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Fundraising and Partnerships'
UNION ALL
SELECT 'Digital Conservation Education', 'Online courses and resources for remote learning about conservation.', d.id, 'active', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Innovation and IT'
UNION ALL
SELECT 'Wildlife Rehabilitation', 'Rescuing and rehabilitating injured wildlife for release back to the wild.', d.id, 'active', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Wildlife Conservation';

-- ============================================
-- 12. EVENTS
-- ============================================
INSERT INTO `events` (`program_id`, `title`, `description`, `location`, `start_datetime`, `end_datetime`, `capacity`, `banner_image`, `status`, `created_at`, `updated_at`, `deleted_at`)
SELECT p.id, 'School Outreach Day', 'Interactive conservation workshop for local schools', 'Nairobi National Park', '2026-04-15 09:00:00', '2026-04-15 15:00:00', 100, '/uploads/events/school-outreach.jpg', 'upcoming', NOW(), NOW(), NULL
FROM programs p WHERE p.title = 'School Conservation Education'
UNION ALL
SELECT p.id, 'Community Conservation Talk', 'Monthly community meeting on wildlife coexistence', 'Kibera Community Center', '2026-04-20 14:00:00', '2026-04-20 17:00:00', 50, '/uploads/events/community-talk.jpg', 'upcoming', NOW(), NOW(), NULL
FROM programs p WHERE p.title = 'Community Wildlife Workshops'
UNION ALL
SELECT p.id, 'Beach Cleanup Day', 'Community beach cleanup and marine education', 'Nyali Beach, Mombasa', '2026-05-05 08:00:00', '2026-05-05 13:00:00', 200, '/uploads/events/beach-cleanup.jpg', 'upcoming', NOW(), NOW(), NULL
FROM programs p WHERE p.title = 'Marine Conservation Initiative'
UNION ALL
SELECT p.id, 'Youth Conservation Camp', 'Week-long camp for young conservationists', 'Ol Pejeta Conservancy', '2026-07-10 08:00:00', '2026-07-17 17:00:00', 30, '/uploads/events/youth-camp.jpg', 'upcoming', NOW(), NOW(), NULL
FROM programs p WHERE p.title = 'Youth Conservation Corps'
UNION ALL
SELECT NULL, 'Annual Conservation Gala', 'Fundraising gala with keynote speakers and awards', 'Nairobi Serena Hotel', '2026-09-25 18:00:00', '2026-09-25 23:00:00', 300, '/uploads/events/gala-2026.jpg', 'upcoming', NOW(), NOW(), NULL
UNION ALL
SELECT p.id, 'Bird Watching Workshop', 'Learn to identify local bird species', 'Karura Forest', '2026-04-10 07:00:00', '2026-04-10 11:00:00', 25, '/uploads/events/bird-watching.jpg', 'upcoming', NOW(), NOW(), NULL
FROM programs p WHERE p.title = 'Community Wildlife Workshops'
UNION ALL
SELECT p.id, 'Wildlife Rehabilitation Training', 'Training for volunteers on wildlife rescue', 'AnimalIQ Rescue Center', '2026-05-15 10:00:00', '2026-05-15 16:00:00', 20, '/uploads/events/rehab-training.jpg', 'upcoming', NOW(), NOW(), NULL
FROM programs p WHERE p.title = 'Wildlife Rehabilitation'
UNION ALL
SELECT p.id, 'Virtual Conservation Webinar', 'Online presentation on conservation careers', 'Zoom Webinar', '2026-04-25 16:00:00', '2026-04-25 18:00:00', 500, '/uploads/events/webinar-2026.jpg', 'upcoming', NOW(), NOW(), NULL
FROM programs p WHERE p.title = 'School Conservation Education';

-- ============================================
-- 13. EVENT REGISTRATIONS
-- ============================================
INSERT INTO `event_registrations` (`event_id`, `user_id`, `status`, `check_in_time`, `created_at`, `updated_at`)
SELECT e.id, u.id, 'registered', NULL, NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Bird Watching Workshop' AND u.email = 'mary.atieno@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'registered', NULL, NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Bird Watching Workshop' AND u.email = 'john.kariuki@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'registered', NULL, NOW(), NOW()
FROM events e, users u
WHERE e.title = 'School Outreach Day' AND u.email = 'james.kipchoge@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'attended', '2026-03-20 14:10:00', NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Community Conservation Talk' AND u.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'attended', '2026-03-20 14:05:00', NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Community Conservation Talk' AND u.email = 'mary.atieno@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'attended', '2026-03-20 14:00:00', NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Community Conservation Talk' AND u.email = 'john.kariuki@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'registered', NULL, NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Wildlife Rehabilitation Training' AND u.email = 'david.omondi@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'registered', NULL, NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Wildlife Rehabilitation Training' AND u.email = 'agnes.njeri@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'registered', NULL, NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Virtual Conservation Webinar' AND u.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT e.id, u.id, 'registered', NULL, NOW(), NOW()
FROM events e, users u
WHERE e.title = 'Virtual Conservation Webinar' AND u.email = 'michael.mwangi@animaliq.org';

-- ============================================
-- 14. RESEARCH PROJECTS
-- ============================================
INSERT INTO `research_projects` (`title`, `summary`, `banner_image`, `department_id`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`, `deleted_at`)
SELECT 'Marine Turtle Migration Patterns', 'Tracking sea turtle movements along the Kenyan coast using satellite telemetry to inform conservation strategies.', '/uploads/research/turtle-migration.jpg', d.id, '2025-01-15', '2026-12-31', 'ongoing', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Wildlife Conservation'
UNION ALL
SELECT 'Human-Wildlife Conflict Assessment', 'Studying patterns of human-wildlife conflict in communities adjacent to national parks.', '/uploads/research/hwc-study.jpg', d.id, '2025-03-01', '2026-08-30', 'ongoing', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Education and Research'
UNION ALL
SELECT 'Forest Bird Population Survey', 'Comprehensive survey of bird populations in fragmented forest ecosystems.', '/uploads/research/bird-survey.jpg', d.id, '2025-02-10', '2025-11-15', 'completed', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Education and Research'
UNION ALL
SELECT 'Coral Reef Health Monitoring', 'Annual assessment of coral reef health and biodiversity in marine protected areas.', '/uploads/research/coral-health.jpg', d.id, '2025-04-01', '2026-04-01', 'ongoing', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Wildlife Conservation'
UNION ALL
SELECT 'Community Conservation Impact Study', 'Evaluating the effectiveness of community-based conservation programs.', '/uploads/research/community-impact.jpg', d.id, '2025-05-15', '2026-05-15', 'ongoing', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Community Outreach'
UNION ALL
SELECT 'Elephant Corridor Usage Analysis', 'Using camera traps to study elephant movement through wildlife corridors.', '/uploads/research/elephant-corridor.jpg', d.id, '2025-06-01', '2027-06-01', 'ongoing', NOW(), NOW(), NULL
FROM departments d WHERE d.name = 'Wildlife Conservation';

-- ============================================
-- 15. RESEARCH REPORTS
-- ============================================
INSERT INTO `research_reports` (`project_id`, `title`, `file_path`, `banner_image`, `published_at`, `created_at`, `updated_at`)
SELECT rp.id, 'Final Report: Forest Bird Populations in Central Kenya', '/uploads/reports/bird-population-2025.pdf', '/uploads/reports/bird-report-banner.jpg', '2025-12-10', NOW(), NOW()
FROM research_projects rp WHERE rp.title = 'Forest Bird Population Survey'
UNION ALL
SELECT rp.id, 'Interim Findings: Human-Wildlife Conflict Patterns', '/uploads/reports/hwc-interim-2025.pdf', '/uploads/reports/hwc-banner.jpg', '2025-08-15', NOW(), NOW()
FROM research_projects rp WHERE rp.title = 'Human-Wildlife Conflict Assessment'
UNION ALL
SELECT rp.id, 'Marine Turtle Migration: Year 1 Report', '/uploads/reports/turtle-migration-year1.pdf', '/uploads/reports/turtle-banner.jpg', '2025-12-20', NOW(), NOW()
FROM research_projects rp WHERE rp.title = 'Marine Turtle Migration Patterns'
UNION ALL
SELECT rp.id, 'Coral Reef Health: Baseline Assessment', '/uploads/reports/coral-baseline-2025.pdf', '/uploads/reports/coral-banner.jpg', '2025-09-30', NOW(), NOW()
FROM research_projects rp WHERE rp.title = 'Coral Reef Health Monitoring'
UNION ALL
SELECT rp.id, 'Community Conservation: Preliminary Findings', '/uploads/reports/community-prelim-2025.pdf', '/uploads/reports/community-banner.jpg', '2025-11-05', NOW(), NOW()
FROM research_projects rp WHERE rp.title = 'Community Conservation Impact Study';

-- ============================================
-- 16. CAMPAIGNS (Awareness & Fundraising)
-- ============================================
INSERT INTO `campaigns` (`title`, `description`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Save Our Coastal Forests', 'Awareness campaign about the importance of coastal forests for biodiversity.', '2026-03-01', '2026-06-30', NOW(), NOW(), NULL),
('Plastic-Free Oceans', 'Campaign to reduce plastic pollution in marine environments.', '2026-04-01', '2026-09-30', NOW(), NOW(), NULL),
('Adopt an Acre', 'Fundraising campaign to protect critical wildlife habitat.', '2026-01-01', '2026-12-31', NOW(), NOW(), NULL),
('Wildlife Warriors', 'Youth engagement campaign for conservation awareness.', '2026-02-01', '2026-11-30', NOW(), NOW(), NULL);

-- ============================================
-- 17. DONATION CAMPAIGNS (Fundraising)
-- ============================================
INSERT INTO `donation_campaigns` (`title`, `description`, `target_amount`, `start_date`, `end_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
('Emergency Wildlife Rescue Fund', 'Support urgent wildlife rescue and rehabilitation efforts.', 50000.00, '2026-01-01', '2026-12-31', NOW(), NOW(), NULL),
('School Conservation Program', 'Fund conservation education in 50 local schools.', 25000.00, '2026-02-01', '2026-10-31', NOW(), NOW(), NULL),
('Marine Protection Initiative', 'Support marine conservation and research.', 75000.00, '2026-03-01', '2026-12-31', NOW(), NOW(), NULL),
('Community Outreach Vehicle', 'Purchase a vehicle for community outreach programs.', 30000.00, '2026-04-01', '2026-09-30', NOW(), NOW(), NULL);

-- ============================================
-- 18. DONATIONS (Sample Transactions)
-- ============================================
INSERT INTO `donations` (`user_id`, `campaign_id`, `amount`, `payment_method`, `transaction_reference`, `donated_at`, `created_at`, `updated_at`)
SELECT u.id, dc.id, 1000.00, 'mpesa', 'MPESA-TXN-001', '2026-03-01 10:30:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'osumbaevans21@gmail.com' AND dc.title = 'Emergency Wildlife Rescue Fund'
UNION ALL
SELECT u.id, dc.id, 500.00, 'bank_transfer', 'BANK-REF-001', '2026-03-02 14:15:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'osumbaevanzz@gmail.com' AND dc.title = 'Emergency Wildlife Rescue Fund'
UNION ALL
SELECT u.id, dc.id, 2500.00, 'credit_card', 'CARD-202603-001', '2026-03-03 09:45:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'sarah.johnson@animaliq.org' AND dc.title = 'School Conservation Program'
UNION ALL
SELECT u.id, dc.id, 750.00, 'paypal', 'PAYPAL-202603-001', '2026-03-05 16:20:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'michael.mwangi@animaliq.org' AND dc.title = 'School Conservation Program'
UNION ALL
SELECT u.id, dc.id, 5000.00, 'mpesa', 'MPESA-TXN-002', '2026-03-07 11:10:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'grace.akinyi@animaliq.org' AND dc.title = 'Marine Protection Initiative'
UNION ALL
SELECT u.id, dc.id, 1200.00, 'bank_transfer', 'BANK-REF-002', '2026-03-08 13:30:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'david.omondi@animaliq.org' AND dc.title = 'Marine Protection Initiative'
UNION ALL
SELECT u.id, dc.id, 2000.00, 'credit_card', 'CARD-202603-002', '2026-03-10 15:45:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'lucy.wambui@animaliq.org' AND dc.title = 'Community Outreach Vehicle'
UNION ALL
SELECT u.id, dc.id, 350.00, 'mpesa', 'MPESA-TXN-003', '2026-03-12 08:20:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'james.kipchoge@animaliq.org' AND dc.title = 'Emergency Wildlife Rescue Fund'
UNION ALL
SELECT u.id, dc.id, 1500.00, 'paypal', 'PAYPAL-202603-002', '2026-03-14 12:00:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'agnes.njeri@animaliq.org' AND dc.title = 'School Conservation Program'
UNION ALL
SELECT u.id, dc.id, 800.00, 'bank_transfer', 'BANK-REF-003', '2026-03-15 10:30:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'peter.odhiambo@animaliq.org' AND dc.title = 'Marine Protection Initiative'
UNION ALL
SELECT u.id, dc.id, 100.00, 'mpesa', 'MPESA-TXN-004', '2026-03-16 09:15:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'mary.atieno@animaliq.org' AND dc.title = 'Community Outreach Vehicle'
UNION ALL
SELECT u.id, dc.id, 250.00, 'credit_card', 'CARD-202603-003', '2026-03-17 14:45:00', NOW(), NOW()
FROM users u, donation_campaigns dc
WHERE u.email = 'john.kariuki@animaliq.org' AND dc.title = 'Emergency Wildlife Rescue Fund';

-- ============================================
-- 19. MEMBERSHIPS (Member Records)
-- ============================================
INSERT INTO `memberships` (`user_id`, `membership_type`, `join_date`, `status`, `created_at`, `updated_at`)
SELECT u.id, 'lifetime', '2020-01-15', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'osumbaevans21@gmail.com'
UNION ALL
SELECT u.id, 'annual', '2021-03-10', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'osumbaevanzz@gmail.com'
UNION ALL
SELECT u.id, 'annual', '2022-05-22', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT u.id, 'annual', '2023-02-18', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'michael.mwangi@animaliq.org'
UNION ALL
SELECT u.id, 'annual', '2023-06-30', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, 'annual', '2024-01-05', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'david.omondi@animaliq.org'
UNION ALL
SELECT u.id, 'annual', '2024-03-12', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'lucy.wambui@animaliq.org'
UNION ALL
SELECT u.id, 'annual', '2024-07-20', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'james.kipchoge@animaliq.org'
UNION ALL
SELECT u.id, 'annual', '2024-09-15', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'agnes.njeri@animaliq.org'
UNION ALL
SELECT u.id, 'annual', '2025-01-25', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'peter.odhiambo@animaliq.org'
UNION ALL
SELECT u.id, 'student', '2025-02-10', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'mary.atieno@animaliq.org'
UNION ALL
SELECT u.id, 'student', '2025-03-05', 'active', NOW(), NOW()
FROM users u WHERE u.email = 'john.kariuki@animaliq.org';

-- ============================================
-- 20. VOLUNTEER HOURS
-- ============================================
INSERT INTO `volunteer_hours` (`user_id`, `event_id`, `hours_logged`, `approved_by`, `created_at`, `updated_at`)
SELECT u.id, e.id, 4.50, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'mary.atieno@animaliq.org' AND e.title = 'Community Conservation Talk' AND approver.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, e.id, 4.50, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'john.kariuki@animaliq.org' AND e.title = 'Community Conservation Talk' AND approver.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, e.id, 6.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'grace.akinyi@animaliq.org' AND e.title = 'School Outreach Day' AND approver.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT u.id, e.id, 6.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'james.kipchoge@animaliq.org' AND e.title = 'School Outreach Day' AND approver.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT u.id, e.id, 35.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'mary.atieno@animaliq.org' AND e.title = 'Youth Conservation Camp' AND approver.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, e.id, 35.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'john.kariuki@animaliq.org' AND e.title = 'Youth Conservation Camp' AND approver.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, e.id, 4.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'sarah.johnson@animaliq.org' AND e.title = 'Bird Watching Workshop' AND approver.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, e.id, 4.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'michael.mwangi@animaliq.org' AND e.title = 'Bird Watching Workshop' AND approver.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, e.id, 5.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'david.omondi@animaliq.org' AND e.title = 'Beach Cleanup Day' AND approver.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, e.id, 5.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'agnes.njeri@animaliq.org' AND e.title = 'Beach Cleanup Day' AND approver.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, e.id, 8.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'peter.odhiambo@animaliq.org' AND e.title = 'Annual Conservation Gala' AND approver.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT u.id, e.id, 8.00, approver.id, NOW(), NOW()
FROM users u, events e, users approver
WHERE u.email = 'osumbaevanzz@gmail.com' AND e.title = 'Annual Conservation Gala' AND approver.email = 'sarah.johnson@animaliq.org';

-- ============================================
-- 21. POSTS (Blog/News Articles)
-- ============================================
INSERT INTO `posts` (`campaign_id`, `author_id`, `title`, `content`, `featured_image`, `status`, `published_at`, `created_at`, `updated_at`, `deleted_at`)
SELECT c.id, u.id, 'Celebrating World Wildlife Day 2026', '<p>World Wildlife Day 2026 was a tremendous success! We engaged over 500 community members in conservation activities across Nairobi.</p><p>Highlights included guided nature walks, wildlife photography workshops, and educational sessions for local schools.</p><p>Thank you to all our volunteers and partners who made this day possible.</p>', '/uploads/posts/world-wildlife-day-2026.jpg', 'published', '2026-03-04 08:00:00', NOW(), NOW(), NULL
FROM campaigns c, users u
WHERE c.title = 'Save Our Coastal Forests' AND u.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT c.id, u.id, '5 Simple Ways to Reduce Plastic Use', '<p>Plastic pollution is one of the greatest threats to marine life. Here are five simple changes you can make today:</p><ul><li>Carry a reusable water bottle</li><li>Bring your own shopping bags</li><li>Avoid single-use plastics</li><li>Choose products with minimal packaging</li><li>Participate in beach cleanups</li></ul>', '/uploads/posts/reduce-plastic.jpg', 'published', '2026-03-01 10:30:00', NOW(), NOW(), NULL
FROM campaigns c, users u
WHERE c.title = 'Plastic-Free Oceans' AND u.email = 'james.kipchoge@animaliq.org'
UNION ALL
SELECT c.id, u.id, 'New Research: Marine Turtle Migration', '<p>Our marine research team has published new findings on sea turtle migration patterns along the Kenyan coast. Using satellite tracking technology, we have identified critical feeding and nesting grounds that need protection.</p><p>The study reveals that turtles travel up to 2,000 kilometers between nesting seasons, crossing international waters and highlighting the need for regional cooperation in marine conservation.</p>', '/uploads/posts/turtle-research.jpg', 'published', '2026-02-28 14:15:00', NOW(), NOW(), NULL
FROM campaigns c, users u
WHERE c.title = 'Adopt an Acre' AND u.email = 'michael.mwangi@animaliq.org'
UNION ALL
SELECT c.id, u.id, 'Introducing Our Youth Conservation Program', '<p>We are thrilled to announce the launch of our Youth Conservation Corps summer program! Open to young people aged 15-18, this immersive experience will include wildlife monitoring, habitat restoration, and leadership training.</p><p>Applications are now open for the July 2026 session. Limited spots available!</p>', '/uploads/posts/youth-program.jpg', 'published', '2026-02-15 09:00:00', NOW(), NOW(), NULL
FROM campaigns c, users u
WHERE c.title = 'Wildlife Warriors' AND u.email = 'peter.odhiambo@animaliq.org'
UNION ALL
SELECT c.id, u.id, 'Community Spotlight: Kibera Conservation Group', '<p>This month we highlight the incredible work of the Kibera Conservation Group, a community-led initiative promoting urban conservation and environmental awareness.</p><p>From tree planting to waste management, this group is making a difference in one of Nairobi\'s largest informal settlements.</p>', '/uploads/posts/community-spotlight.jpg', 'published', '2026-02-10 11:45:00', NOW(), NOW(), NULL
FROM campaigns c, users u
WHERE c.title = 'Save Our Coastal Forests' AND u.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT c.id, u.id, 'Coral Reef Conservation: Why It Matters', '<p>Coral reefs are often called the "rainforests of the sea" due to their incredible biodiversity. Yet these vital ecosystems are under threat from climate change, pollution, and overfishing.</p><p>Our marine team is working with local communities to establish community-managed marine areas and promote sustainable fishing practices.</p>', '/uploads/posts/coral-reefs.jpg', 'published', '2026-01-25 13:20:00', NOW(), NOW(), NULL
FROM campaigns c, users u
WHERE c.title = 'Plastic-Free Oceans' AND u.email = 'david.omondi@animaliq.org';

-- ============================================
-- 22. MEDIA LIBRARY
-- ============================================
INSERT INTO `media_library` (`file_path`, `file_type`, `uploaded_by`, `alt_text`, `created_at`, `updated_at`)
SELECT '/uploads/media/elephant-hero.jpg', 'image', u.id, 'Elephant in Amboseli National Park', NOW(), NOW()
FROM users u WHERE u.email = 'peter.odhiambo@animaliq.org'
UNION ALL
SELECT '/uploads/media/lion-conservation.jpg', 'image', u.id, 'Lion in Maasai Mara', NOW(), NOW()
FROM users u WHERE u.email = 'peter.odhiambo@animaliq.org'
UNION ALL
SELECT '/uploads/media/community-workshop.jpg', 'image', u.id, 'Community conservation workshop', NOW(), NOW()
FROM users u WHERE u.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT '/uploads/media/beach-cleanup-2026.jpg', 'image', u.id, 'Volunteers during beach cleanup', NOW(), NOW()
FROM users u WHERE u.email = 'david.omondi@animaliq.org'
UNION ALL
SELECT '/uploads/media/turtle-release.jpg', 'image', u.id, 'Releasing rehabilitated sea turtle', NOW(), NOW()
FROM users u WHERE u.email = 'david.omondi@animaliq.org'
UNION ALL
SELECT '/uploads/media/conservation-education.jpg', 'image', u.id, 'School children learning about conservation', NOW(), NOW()
FROM users u WHERE u.email = 'james.kipchoge@animaliq.org'
UNION ALL
SELECT '/uploads/media/research-team.jpg', 'image', u.id, 'Research team in the field', NOW(), NOW()
FROM users u WHERE u.email = 'michael.mwangi@animaliq.org'
UNION ALL
SELECT '/uploads/media/volunteer-training.jpg', 'image', u.id, 'Volunteers during training session', NOW(), NOW()
FROM users u WHERE u.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT '/uploads/media/annual-gala-2025.jpg', 'image', u.id, 'Annual Conservation Gala 2025', NOW(), NOW()
FROM users u WHERE u.email = 'peter.odhiambo@animaliq.org'
UNION ALL
SELECT '/uploads/media/bird-watching.jpg', 'image', u.id, 'Bird watching activity', NOW(), NOW()
FROM users u WHERE u.email = 'james.kipchoge@animaliq.org'
UNION ALL
SELECT '/uploads/intro-video-2026.mp4', 'video', u.id, 'Introduction to AnimalIQ', NOW(), NOW()
FROM users u WHERE u.email = 'peter.odhiambo@animaliq.org';

-- ============================================
-- 23. PRODUCTS (Merchandise)
-- ============================================
INSERT INTO `products` (`name`, `description`, `price`, `stock`, `image_path`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
('AnimalIQ T-Shirt', '100% organic cotton t-shirt with AnimalIQ logo. Available in S, M, L, XL.', 25.00, 100, '/uploads/products/tshirt.jpg', 'active', NOW(), NOW(), NULL),
('Conservation Hoodie', 'Comfortable hoodie featuring wildlife design. Perfect for cool evenings.', 45.00, 50, '/uploads/products/hoodie.jpg', 'active', NOW(), NOW(), NULL),
('Reusable Water Bottle', 'Stainless steel water bottle with conservation message. 750ml capacity.', 15.00, 200, '/uploads/products/bottle.jpg', 'active', NOW(), NOW(), NULL),
('Wildlife Calendar 2026', 'Beautiful calendar featuring wildlife photography from our team.', 12.00, 150, '/uploads/products/calendar-2026.jpg', 'active', NOW(), NOW(), NULL),
('Conservation Book: "Our Wild Heritage"', 'Coffee table book featuring stunning photography and conservation stories.', 35.00, 75, '/uploads/products/book.jpg', 'active', NOW(), NOW(), NULL),
('Tote Bag', 'Reusable cotton tote bag with "Protect Our Wildlife" design.', 10.00, 300, '/uploads/products/tote-bag.jpg', 'active', NOW(), NOW(), NULL),
('AnimalIQ Cap', 'Adjustable cap with embroidered logo. One size fits most.', 18.00, 120, '/uploads/products/cap.jpg', 'active', NOW(), NOW(), NULL);

-- ============================================
-- 24. ORDERS (Sample Orders)
-- ============================================
INSERT INTO `orders` (`user_id`, `total_amount`, `payment_status`, `transaction_reference`, `created_at`, `updated_at`)
SELECT u.id, 40.00, 'paid', 'ORDER-MPESA-001', NOW(), NOW()
FROM users u WHERE u.email = 'mary.atieno@animaliq.org'
UNION ALL
SELECT u.id, 45.00, 'paid', 'ORDER-MPESA-002', NOW(), NOW()
FROM users u WHERE u.email = 'john.kariuki@animaliq.org'
UNION ALL
SELECT u.id, 60.00, 'paid', 'ORDER-CARD-001', NOW(), NOW()
FROM users u WHERE u.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT u.id, 25.00, 'paid', 'ORDER-PAYPAL-001', NOW(), NOW()
FROM users u WHERE u.email = 'michael.mwangi@animaliq.org'
UNION ALL
SELECT u.id, 55.00, 'pending', 'ORDER-BANK-001', NOW(), NOW()
FROM users u WHERE u.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, 70.00, 'paid', 'ORDER-MPESA-003', NOW(), NOW()
FROM users u WHERE u.email = 'osumbaevanzz@gmail.com'
UNION ALL
SELECT u.id, 90.00, 'paid', 'ORDER-CARD-002', NOW(), NOW()
FROM users u WHERE u.email = 'osumbaevans21@gmail.com';

-- ============================================
-- 25. ORDER ITEMS
-- ============================================
INSERT INTO `order_items` (`order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`)
SELECT o.id, p.id, 1, 25.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'mary.atieno@animaliq.org' AND p.name = 'AnimalIQ T-Shirt'
UNION ALL
SELECT o.id, p.id, 1, 12.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'mary.atieno@animaliq.org' AND p.name = 'Wildlife Calendar 2026'
UNION ALL
SELECT o.id, p.id, 1, 10.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'mary.atieno@animaliq.org' AND p.name = 'Tote Bag'
UNION ALL
SELECT o.id, p.id, 1, 45.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'john.kariuki@animaliq.org' AND p.name = 'Conservation Hoodie'
UNION ALL
SELECT o.id, p.id, 2, 15.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'sarah.johnson@animaliq.org' AND p.name = 'Reusable Water Bottle'
UNION ALL
SELECT o.id, p.id, 1, 18.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'sarah.johnson@animaliq.org' AND p.name = 'AnimalIQ Cap'
UNION ALL
SELECT o.id, p.id, 1, 10.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'sarah.johnson@animaliq.org' AND p.name = 'Tote Bag'
UNION ALL
SELECT o.id, p.id, 1, 25.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'michael.mwangi@animaliq.org' AND p.name = 'AnimalIQ T-Shirt'
UNION ALL
SELECT o.id, p.id, 1, 35.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'grace.akinyi@animaliq.org' AND p.name = 'Conservation Book: "Our Wild Heritage"'
UNION ALL
SELECT o.id, p.id, 1, 12.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'grace.akinyi@animaliq.org' AND p.name = 'Wildlife Calendar 2026'
UNION ALL
SELECT o.id, p.id, 1, 10.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'grace.akinyi@animaliq.org' AND p.name = 'Tote Bag'
UNION ALL
SELECT o.id, p.id, 1, 45.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'osumbaevanzz@gmail.com' AND p.name = 'Conservation Hoodie'
UNION ALL
SELECT o.id, p.id, 1, 15.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'osumbaevanzz@gmail.com' AND p.name = 'Reusable Water Bottle'
UNION ALL
SELECT o.id, p.id, 1, 18.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'osumbaevanzz@gmail.com' AND p.name = 'AnimalIQ Cap'
UNION ALL
SELECT o.id, p.id, 2, 25.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'osumbaevans21@gmail.com' AND p.name = 'AnimalIQ T-Shirt'
UNION ALL
SELECT o.id, p.id, 1, 35.00, NOW(), NOW()
FROM orders o, products p, users u
WHERE o.user_id = u.id AND u.email = 'osumbaevans21@gmail.com' AND p.name = 'Conservation Book: "Our Wild Heritage"';

-- ============================================
-- 26. AUDIT LOGS (Sample Activity)
-- ============================================
INSERT INTO `audit_logs` (`user_id`, `action`, `table_name`, `record_id`, `created_at`)
SELECT u.id, 'Created new user', 'users', (SELECT id FROM users WHERE email = 'sarah.johnson@animaliq.org'), NOW()
FROM users u WHERE u.email = 'osumbaevans21@gmail.com'
UNION ALL
SELECT u.id, 'Updated site settings', 'site_settings', 1, NOW()
FROM users u WHERE u.email = 'osumbaevans21@gmail.com'
UNION ALL
SELECT u.id, 'Published new post', 'posts', (SELECT id FROM posts WHERE title = 'Celebrating World Wildlife Day 2026'), NOW()
FROM users u WHERE u.email = 'osumbaevanzz@gmail.com'
UNION ALL
SELECT u.id, 'Created event', 'events', (SELECT id FROM events WHERE title = 'School Outreach Day'), NOW()
FROM users u WHERE u.email = 'sarah.johnson@animaliq.org'
UNION ALL
SELECT u.id, 'Approved volunteer hours', 'volunteer_hours', 1, NOW()
FROM users u WHERE u.email = 'grace.akinyi@animaliq.org'
UNION ALL
SELECT u.id, 'Processed donation', 'donations', 1, NOW()
FROM users u WHERE u.email = 'lucy.wambui@animaliq.org'
UNION ALL
SELECT u.id, 'Added research project', 'research_projects', (SELECT id FROM research_projects WHERE title = 'Marine Turtle Migration Patterns'), NOW()
FROM users u WHERE u.email = 'michael.mwangi@animaliq.org'
UNION ALL
SELECT u.id, 'Updated homepage slide', 'homepage_slides', 1, NOW()
FROM users u WHERE u.email = 'james.kipchoge@animaliq.org';

-- Commit the transaction
COMMIT;

-- Re-enable foreign key checks
SET FOREIGN_KEY_CHECKS = 1;

-- ============================================
-- VERIFICATION QUERIES
-- ============================================
SELECT 'USERS' as 'Table', COUNT(*) as 'Record Count' FROM users UNION ALL
SELECT 'ROLES', COUNT(*) FROM roles UNION ALL
SELECT 'PERMISSIONS', COUNT(*) FROM permissions UNION ALL
SELECT 'DEPARTMENTS', COUNT(*) FROM departments UNION ALL
SELECT 'DEPARTMENT_MEMBERS', COUNT(*) FROM department_members UNION ALL
SELECT 'TEAM_MEMBERS', COUNT(*) FROM team_members UNION ALL
SELECT 'PROGRAMS', COUNT(*) FROM programs UNION ALL
SELECT 'EVENTS', COUNT(*) FROM events UNION ALL
SELECT 'EVENT_REGISTRATIONS', COUNT(*) FROM event_registrations UNION ALL
SELECT 'RESEARCH_PROJECTS', COUNT(*) FROM research_projects UNION ALL
SELECT 'RESEARCH_REPORTS', COUNT(*) FROM research_reports UNION ALL
SELECT 'CAMPAIGNS', COUNT(*) FROM campaigns UNION ALL
SELECT 'DONATION_CAMPAIGNS', COUNT(*) FROM donation_campaigns UNION ALL
SELECT 'DONATIONS', COUNT(*) FROM donations UNION ALL
SELECT 'MEMBERSHIPS', COUNT(*) FROM memberships UNION ALL
SELECT 'VOLUNTEER_HOURS', COUNT(*) FROM volunteer_hours UNION ALL
SELECT 'POSTS', COUNT(*) FROM posts UNION ALL
SELECT 'MEDIA_LIBRARY', COUNT(*) FROM media_library UNION ALL
SELECT 'PRODUCTS', COUNT(*) FROM products UNION ALL
SELECT 'ORDERS', COUNT(*) FROM orders UNION ALL
SELECT 'ORDER_ITEMS', COUNT(*) FROM order_items UNION ALL
SELECT 'AUDIT_LOGS', COUNT(*) FROM audit_logs;