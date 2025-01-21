CREATE DATABASE amigaru;
CREATE USER amigaru_user WITH PASSWORD 'yourpassword';
GRANT ALL PRIVILEGES ON DATABASE amigaru TO amigaru_user;

CREATE TABLE "Users" (
  "id" integer PRIMARY KEY,
  "email" varchar UNIQUE,
  "password" varchar,
  "role" enum(admin,streamer)
);

CREATE TABLE "Pages" (
  "id" integer PRIMARY KEY,
  "user_id" integer NOT NULL,
  "title" varchar
);

CREATE TABLE "Sections" (
  "id" integer PRIMARY KEY,
  "page_id" integer NOT NULL,
  "section_number" integer,
  "content_type" (text,image,title),
  "content" text
);

CREATE TABLE "Images" (
  "id" integer PRIMARY KEY,
  "section_id" integer NOT NULL,
  "url" varchar,
  "alt_text" varchar,
  "width" integer,
  "height" integer
);

COMMENT ON COLUMN "Sections"."section_number" IS '1 to 5';

COMMENT ON COLUMN "Images"."url" IS 'Max 2083 characters for URL';

ALTER TABLE "Pages" ADD FOREIGN KEY ("user_id") REFERENCES "Users" ("id");

ALTER TABLE "Sections" ADD FOREIGN KEY ("page_id") REFERENCES "Pages" ("id");

ALTER TABLE "Images" ADD FOREIGN KEY ("section_id") REFERENCES "Sections" ("id");
