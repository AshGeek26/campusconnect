CREATE DATABASE campus_connect;

USE campus_connect;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'faculty', 'admin') DEFAULT 'student',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    author_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (author_id) REFERENCES users(id)
);

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(255),
    category VARCHAR(100),
    message TEXT,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE student_government_updates (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    content TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

































-- -- Drop the database if it already exists
-- DROP DATABASE IF EXISTS campus_connect;

-- -- Create a new database
-- CREATE DATABASE campus_connect;

-- -- Use the database
-- USE campus_connect;

-- -- Users Table
-- CREATE TABLE Users (
--     user_id INT PRIMARY KEY AUTO_INCREMENT,
--     email VARCHAR(255) UNIQUE NOT NULL,
--     password_hash VARCHAR(255) NOT NULL,
--     first_name VARCHAR(100) NOT NULL,
--     last_name VARCHAR(100) NOT NULL,
--     role ENUM('student', 'faculty', 'staff', 'admin') NOT NULL,
--     department VARCHAR(100),
--     profile_picture_url VARCHAR(255),
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     last_login TIMESTAMP NULL
-- );

-- -- User Verification/Roles Table
-- CREATE TABLE UserRoles (
--     role_id INT PRIMARY KEY AUTO_INCREMENT,
--     user_id INT,
--     role_type ENUM('verified_student', 'student_gov', 'club_leader', 'campus_staff') NOT NULL,
--     verified_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (user_id) REFERENCES Users(user_id)
-- );

-- -- Posts/News Table
-- CREATE TABLE Posts (
--     post_id INT PRIMARY KEY AUTO_INCREMENT,
--     user_id INT NOT NULL,
--     title VARCHAR(255) NOT NULL,
--     content TEXT NOT NULL,
--     category ENUM('general', 'student_gov', 'sports', 'clubs', 'events', 'academic') NOT NULL,
--     image_url VARCHAR(255),
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
--     status ENUM('draft', 'published', 'archived') DEFAULT 'draft',
--     views INT DEFAULT 0,
--     FOREIGN KEY (user_id) REFERENCES Users(user_id)
-- );

-- -- Comments Table
-- CREATE TABLE Comments (
--     comment_id INT PRIMARY KEY AUTO_INCREMENT,
--     post_id INT NOT NULL,
--     user_id INT NOT NULL,
--     content TEXT NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     likes INT DEFAULT 0,
--     FOREIGN KEY (post_id) REFERENCES Posts(post_id),
--     FOREIGN KEY (user_id) REFERENCES Users(user_id)
-- );

-- -- Events Table
-- CREATE TABLE Events (
--     event_id INT PRIMARY KEY AUTO_INCREMENT,
--     title VARCHAR(255) NOT NULL,
--     description TEXT NOT NULL,
--     start_datetime DATETIME NOT NULL,
--     end_datetime DATETIME NOT NULL,
--     location VARCHAR(255),
--     category ENUM('academic', 'cultural', 'sports', 'workshop', 'other') NOT NULL,
--     organizer_id INT NOT NULL,
--     registration_required BOOLEAN DEFAULT FALSE,
--     max_participants INT,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (organizer_id) REFERENCES Users(user_id)
-- );

-- -- Event Registrations
-- CREATE TABLE EventRegistrations (
--     registration_id INT PRIMARY KEY AUTO_INCREMENT,
--     event_id INT NOT NULL,
--     user_id INT NOT NULL,
--     registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     status ENUM('registered', 'attended', 'canceled') DEFAULT 'registered',
--     FOREIGN KEY (event_id) REFERENCES Events(event_id),
--     FOREIGN KEY (user_id) REFERENCES Users(user_id),
--     UNIQUE KEY (event_id, user_id)
-- );

-- -- Feedback/Complaints Table
-- CREATE TABLE Feedback (
--     feedback_id INT PRIMARY KEY AUTO_INCREMENT,
--     user_id INT NOT NULL,
--     title VARCHAR(255) NOT NULL,
--     description TEXT NOT NULL,
--     category ENUM('complaint', 'suggestion', 'praise', 'concern') NOT NULL,
--     status ENUM('pending', 'in_review', 'resolved', 'closed') DEFAULT 'pending',
--     assigned_to INT,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     resolved_at TIMESTAMP NULL,
--     FOREIGN KEY (user_id) REFERENCES Users(user_id),
--     FOREIGN KEY (assigned_to) REFERENCES Users(user_id)
-- );

-- -- Campus Clubs Table
-- CREATE TABLE Clubs (
--     club_id INT PRIMARY KEY AUTO_INCREMENT,
--     name VARCHAR(255) NOT NULL,
--     description TEXT NOT NULL,
--     president_id INT NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     active BOOLEAN DEFAULT TRUE,
--     FOREIGN KEY (president_id) REFERENCES Users(user_id)
-- );

-- -- Club Memberships
-- CREATE TABLE ClubMemberships (
--     membership_id INT PRIMARY KEY AUTO_INCREMENT,
--     club_id INT NOT NULL,
--     user_id INT NOT NULL,
--     joined_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     role ENUM('member', 'officer', 'president') DEFAULT 'member',
--     FOREIGN KEY (club_id) REFERENCES Clubs(club_id),
--     FOREIGN KEY (user_id) REFERENCES Users(user_id),
--     UNIQUE KEY (club_id, user_id)
-- );

-- -- Student Government Updates Table
-- CREATE TABLE StudentGovUpdates (
--     update_id INT PRIMARY KEY AUTO_INCREMENT,
--     department ENUM('welfare', 'sports', 'entertainment', 'outreach', 'finance') NOT NULL,
--     title VARCHAR(255) NOT NULL,
--     content TEXT NOT NULL,
--     published_by INT NOT NULL,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (published_by) REFERENCES Users(user_id)
-- );

-- -- Notification Table
-- CREATE TABLE Notifications (
--     notification_id INT PRIMARY KEY AUTO_INCREMENT,
--     user_id INT NOT NULL,
--     type ENUM('post', 'event', 'feedback', 'club', 'student_gov') NOT NULL,
--     reference_id INT NOT NULL,
--     message TEXT NOT NULL,
--     is_read BOOLEAN DEFAULT FALSE,
--     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
--     FOREIGN KEY (user_id) REFERENCES Users(user_id)
-- );

-- -- Tags Table (for posts and events)
-- CREATE TABLE Tags (
--     tag_id INT PRIMARY KEY AUTO_INCREMENT,
--     tag_name VARCHAR(50) UNIQUE NOT NULL
-- );

-- -- Post-Tag Relationship
-- CREATE TABLE PostTags (
--     post_id INT NOT NULL,
--     tag_id INT NOT NULL,
--     PRIMARY KEY (post_id, tag_id),
--     FOREIGN KEY (post_id) REFERENCES Posts(post_id),
--     FOREIGN KEY (tag_id) REFERENCES Tags(tag_id)
-- );

-- -- Indexes for performance
-- CREATE INDEX idx_posts_category ON Posts(category);
-- CREATE INDEX idx_events_datetime ON Events(start_datetime);
-- CREATE INDEX idx_feedback_status ON Feedback(status);
-- CREATE INDEX idx_user_email ON Users(email);