ALTER TABLE `codex_product_type`
ADD COLUMN `type_name_en`  varchar(255) NULL COMMENT 'ϵ�� Ӣ��' AFTER `image`;

ALTER TABLE `codex_tag_type`
ADD COLUMN `typename_en`  varchar(255) NULL COMMENT '��ǩ��� Ӣ��' AFTER `typename`;

ALTER TABLE `codex_tag`
ADD COLUMN `tag_en`  varchar(255) NULL COMMENT '��ǩ Ӣ��' AFTER `tag_type_id`;

# 2019-03-28

ALTER TABLE `codex_banner`
CHANGE COLUMN `url` `url_cn`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '��ת����' AFTER `title_en2`,
ADD COLUMN `url_en`  varchar(255) NULL AFTER `addtime`;

ALTER TABLE `codex_tag_type`
ADD COLUMN `ord`  smallint(4) UNSIGNED NULL DEFAULT 0 COMMENT '���򣨰���С��' AFTER `typename_en`;

ALTER TABLE `codex_product_type`
ADD COLUMN `ord`  smallint(4) UNSIGNED NULL DEFAULT 0 COMMENT '���򣨰���С��' AFTER `type_name_en`;

ALTER TABLE `codex_product`
ADD COLUMN `ord`  int(10) UNSIGNED NULL DEFAULT 0 COMMENT '���򣨰���С��' AFTER `addtime`;

# 2019-03-29

ALTER TABLE `codex_banner`
ADD COLUMN `type`  tinyint(1) UNSIGNED NULL DEFAULT 1 COMMENT '1-ͼƬ 2-��Ƶ' AFTER `url_en`,
ADD COLUMN `video`  varchar(255) NULL COMMENT '��Ƶ' AFTER `type`;

# 2019-04-03

ALTER TABLE `codex_news`
ADD FULLTEXT INDEX `idx_contents` (`content_cn`, `content_en`) ;

# 2019-04-14

ALTER TABLE `codex_product`
ADD COLUMN `price_en`  decimal(10,2) UNSIGNED NULL COMMENT '�۸�Ӣ��' AFTER `buy_link`;

# 2019-04-18

ALTER TABLE `codex_product`
ADD COLUMN `fs`  varchar(255) NULL COMMENT '��ˮ' AFTER `ord`,
ADD COLUMN `fs_en`  varchar(255) NULL COMMENT '��ˮ Ӣ��' AFTER `fs`;

ALTER TABLE `codex_product`
CHANGE COLUMN `fs` `fs_cn`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '��ˮ' AFTER `ord`;

