CREATE TABLE datum (id BIGSERIAL, file BYTEA, sf_guard_user_id INT, campaign_id BIGINT, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE message (id BIGSERIAL, file BYTEA, sf_guard_user_id INT, campaign_id BIGINT, _from VARCHAR(125), _to VARCHAR(125), message TEXT, type VARCHAR(255), carbon_copy TEXT, blind_carbon_copy TEXT, subject TEXT, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE course (id BIGSERIAL, file BYTEA, sf_guard_user_id INT, campaign_id BIGINT, speed FLOAT, heading FLOAT, heading_accuracy FLOAT, speed_accuracy FLOAT, g_p_s_id BIGINT, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE email_address (id BIGSERIAL, address VARCHAR(100) NOT NULL UNIQUE, disabled BOOLEAN DEFAULT 'false', profile_id BIGINT, PRIMARY KEY(id));
CREATE TABLE g_p_s (id BIGSERIAL, hardware_id BIGINT, PRIMARY KEY(id));
CREATE TABLE phone_number (id BIGSERIAL, number VARCHAR(14) NOT NULL, disabled BOOLEAN DEFAULT 'false', profile_id BIGINT, PRIMARY KEY(id));
CREATE TABLE picture (id BIGSERIAL, file BYTEA, sf_guard_user_id INT, campaign_id BIGINT, resolution BIGINT, quality VARCHAR(10), format VARCHAR(25), created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE position_table (id BIGSERIAL, file BYTEA, sf_guard_user_id INT, campaign_id BIGINT, latitude FLOAT, altitude FLOAT, vertical_accuracy FLOAT, longitude FLOAT, horizontal_accuracy FLOAT, g_p_s_id BIGINT, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE profile (id BIGSERIAL, first_name VARCHAR(128) NOT NULL, middle_name VARCHAR(100), last_name VARCHAR(100) NOT NULL, sf_guard_user_id INT NOT NULL, PRIMARY KEY(id));
CREATE TABLE satellites (id BIGSERIAL, file BYTEA, sf_guard_user_id INT, campaign_id BIGINT, horizontal_dop FLOAT, used_satellites BIGINT, vertical_dop FLOAT, time FLOAT, satellites BIGINT, time_dop FLOAT, g_p_s_id BIGINT, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE sf_guard_group (id SERIAL, name VARCHAR(255) UNIQUE, description VARCHAR(1000), created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE sf_guard_group_permission (group_id INT, permission_id INT, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(group_id, permission_id));
CREATE TABLE sf_guard_permission (id SERIAL, name VARCHAR(255) UNIQUE, description VARCHAR(1000), created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE sf_guard_remember_key (id SERIAL, user_id INT, remember_key VARCHAR(32), ip_address VARCHAR(50), created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id, ip_address));
CREATE TABLE sf_guard_user (id SERIAL, username VARCHAR(128) NOT NULL UNIQUE, algorithm VARCHAR(128) DEFAULT 'sha1' NOT NULL, salt VARCHAR(128), password VARCHAR(128), is_active BOOLEAN DEFAULT 'true', is_super_admin BOOLEAN DEFAULT 'false', last_login TIMESTAMP without time zone, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(id));
CREATE TABLE sf_guard_user_group (user_id INT, group_id INT, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(user_id, group_id));
CREATE TABLE sf_guard_user_permission (user_id INT, permission_id INT, created_at TIMESTAMP without time zone, updated_at TIMESTAMP without time zone, PRIMARY KEY(user_id, permission_id));
CREATE INDEX is_active_idx ON sf_guard_user (is_active);
ALTER TABLE datum ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE message ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE course ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE course ADD FOREIGN KEY (g_p_s_id) REFERENCES g_p_s(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE email_address ADD FOREIGN KEY (profile_id) REFERENCES profile(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE phone_number ADD FOREIGN KEY (profile_id) REFERENCES profile(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE picture ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE position_table ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE position_table ADD FOREIGN KEY (g_p_s_id) REFERENCES g_p_s(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE profile ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE satellites ADD FOREIGN KEY (sf_guard_user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE satellites ADD FOREIGN KEY (g_p_s_id) REFERENCES g_p_s(id) NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_group_permission ADD FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_group_permission ADD FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_remember_key ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_user_group ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_user_group ADD FOREIGN KEY (group_id) REFERENCES sf_guard_group(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_user_permission ADD FOREIGN KEY (user_id) REFERENCES sf_guard_user(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
ALTER TABLE sf_guard_user_permission ADD FOREIGN KEY (permission_id) REFERENCES sf_guard_permission(id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE;
