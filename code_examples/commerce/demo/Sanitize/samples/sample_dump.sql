-- !!!Exercise caution when using TRUNCATE queries with CASCADE options --
TRUNCATE "acme_blog_post";
DELETE FROM "acme_demo_question" WHERE "created_at" < (NOW() - INTERVAL '5 days');
UPDATE "acme_demo_question" SET "due_date"=CURRENT_TIMESTAMP;
DELETE FROM "acme_demo_sms" WHERE "id" NOT IN(SELECT "id" FROM "acme_demo_sms" ORDER BY "id" DESC LIMIT 3);
UPDATE "acme_demo_sms" SET serialized_data = serialized_data || jsonb_build_object('delivery_date', CURRENT_TIMESTAMP(0));
