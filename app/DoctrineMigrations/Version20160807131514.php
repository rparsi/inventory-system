<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160807131514 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE fos_user (id INT UNSIGNED AUTO_INCREMENT NOT NULL, number_id INT UNSIGNED DEFAULT NULL, address_id INT UNSIGNED DEFAULT NULL, locale_id INT UNSIGNED DEFAULT NULL, timezone_id INT UNSIGNED DEFAULT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, salutation VARCHAR(10) NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, registered_date DATETIME DEFAULT NULL, iso_locale VARCHAR(10) DEFAULT NULL, iso_timezone VARCHAR(50) DEFAULT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), INDEX IDX_957A647930A1DE10 (number_id), INDEX IDX_957A6479F5B7AF75 (address_id), INDEX IDX_957A6479E559DFD1 (locale_id), INDEX IDX_957A64793FE997DE (timezone_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_companies (user_id INT UNSIGNED NOT NULL, company_id INT UNSIGNED NOT NULL, INDEX IDX_E439D0DBA76ED395 (user_id), INDEX IDX_E439D0DB979B1AD6 (company_id), PRIMARY KEY(user_id, company_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_numbers (user_id INT UNSIGNED NOT NULL, number_id INT UNSIGNED NOT NULL, INDEX IDX_879EBE33A76ED395 (user_id), INDEX IDX_879EBE3330A1DE10 (number_id), PRIMARY KEY(user_id, number_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_email_addresses (user_id INT UNSIGNED NOT NULL, email_address_id INT UNSIGNED NOT NULL, INDEX IDX_DBB415A7A76ED395 (user_id), INDEX IDX_DBB415A759045DAA (email_address_id), PRIMARY KEY(user_id, email_address_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users_addresses (user_id INT UNSIGNED NOT NULL, address_id INT UNSIGNED NOT NULL, INDEX IDX_9B70FF7A76ED395 (user_id), INDEX IDX_9B70FF7F5B7AF75 (address_id), PRIMARY KEY(user_id, address_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company (id INT UNSIGNED AUTO_INCREMENT NOT NULL, status_id INT UNSIGNED NOT NULL, number_id INT UNSIGNED DEFAULT NULL, email_address_id INT UNSIGNED DEFAULT NULL, address_id INT UNSIGNED DEFAULT NULL, name_ VARCHAR(100) NOT NULL, registered_date DATETIME NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_4FBF094F6BF700BD (status_id), INDEX IDX_4FBF094F30A1DE10 (number_id), INDEX IDX_4FBF094F59045DAA (email_address_id), INDEX IDX_4FBF094FF5B7AF75 (address_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies_types (company_id INT UNSIGNED NOT NULL, type_id INT UNSIGNED NOT NULL, INDEX IDX_BAB9C6D4979B1AD6 (company_id), INDEX IDX_BAB9C6D4C54C8C93 (type_id), PRIMARY KEY(company_id, type_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies_numbers (company_id INT UNSIGNED NOT NULL, number_id INT UNSIGNED NOT NULL, INDEX IDX_ABEF4399979B1AD6 (company_id), INDEX IDX_ABEF439930A1DE10 (number_id), PRIMARY KEY(company_id, number_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies_email_addresses (company_id INT UNSIGNED NOT NULL, email_address_id INT UNSIGNED NOT NULL, INDEX IDX_21DFA99B979B1AD6 (company_id), INDEX IDX_21DFA99B59045DAA (email_address_id), PRIMARY KEY(company_id, email_address_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE companies_addresses (company_id INT UNSIGNED NOT NULL, address_id INT UNSIGNED NOT NULL, INDEX IDX_9E53F944979B1AD6 (company_id), INDEX IDX_9E53F944F5B7AF75 (address_id), PRIMARY KEY(company_id, address_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone_number (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type_id INT UNSIGNED DEFAULT NULL, name_ VARCHAR(100) NOT NULL, country_code VARCHAR(10) NOT NULL, area_code INT UNSIGNED NOT NULL, number_ VARCHAR(30) NOT NULL, extension VARCHAR(30) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_6B01BC5BC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE email_address (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_ VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address (id INT UNSIGNED AUTO_INCREMENT NOT NULL, type_id INT UNSIGNED NOT NULL, country_id INT UNSIGNED NOT NULL, province_id INT UNSIGNED NOT NULL, city_id INT UNSIGNED NOT NULL, name_ VARCHAR(100) NOT NULL, line1 VARCHAR(255) NOT NULL, line2 VARCHAR(255) DEFAULT NULL, postal_code VARCHAR(30) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_D4E6F81C54C8C93 (type_id), INDEX IDX_D4E6F81F92F3E70 (country_id), INDEX IDX_D4E6F81E946114A (province_id), INDEX IDX_D4E6F818BAC62AF (city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE locale (id INT UNSIGNED AUTO_INCREMENT NOT NULL, language_id INT UNSIGNED NOT NULL, country_id INT UNSIGNED NOT NULL, name_ VARCHAR(100) NOT NULL, iso_code VARCHAR(10) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_4180C69882F1BAF4 (language_id), INDEX IDX_4180C698F92F3E70 (country_id), UNIQUE INDEX unique_locale_idx (language_id, country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE timezone (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_ VARCHAR(100) NOT NULL, utc_hours_offset INT NOT NULL, php_timezone VARCHAR(100) NOT NULL, location VARCHAR(100) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_rep (id INT UNSIGNED AUTO_INCREMENT NOT NULL, company_id INT UNSIGNED NOT NULL, user_id INT UNSIGNED DEFAULT NULL, client_company_id INT UNSIGNED NOT NULL, client_user_id INT UNSIGNED DEFAULT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_E4480F9A979B1AD6 (company_id), INDEX IDX_E4480F9AA76ED395 (user_id), INDEX IDX_E4480F9A7CF2797 (client_company_id), INDEX IDX_E4480F9AF55397E8 (client_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_tree (id INT UNSIGNED AUTO_INCREMENT NOT NULL, root_company_id INT UNSIGNED NOT NULL, parent_company_id INT UNSIGNED NOT NULL, child_company_id INT UNSIGNED NOT NULL, name_ VARCHAR(100) NOT NULL, level INT UNSIGNED DEFAULT 1 NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_F453443232D8BDA7 (root_company_id), INDEX IDX_F4534432D0D89E86 (parent_company_id), INDEX IDX_F45344327344E4BD (child_company_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_status (id INT UNSIGNED AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, name_ VARCHAR(100) NOT NULL, slug VARCHAR(30) NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE company_type (id INT UNSIGNED AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, name_ VARCHAR(100) NOT NULL, slug VARCHAR(30) NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE phone_number_type (id INT UNSIGNED AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, name_ VARCHAR(100) NOT NULL, slug VARCHAR(30) NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE province (id INT UNSIGNED AUTO_INCREMENT NOT NULL, country_id INT UNSIGNED NOT NULL, name_ VARCHAR(100) NOT NULL, iso_code VARCHAR(10) NOT NULL, category VARCHAR(30) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_4ADAD40BF92F3E70 (country_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region_item_type (id INT UNSIGNED AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, name_ VARCHAR(100) NOT NULL, slug VARCHAR(30) NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_ VARCHAR(100) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region_item (id INT UNSIGNED AUTO_INCREMENT NOT NULL, parent_region_id INT UNSIGNED NOT NULL, type_id INT UNSIGNED NOT NULL, country_id INT UNSIGNED DEFAULT NULL, province_id INT UNSIGNED DEFAULT NULL, city_id INT UNSIGNED DEFAULT NULL, region_id INT UNSIGNED DEFAULT NULL, name_ VARCHAR(100) NOT NULL, inheritsChildren TINYINT(1) DEFAULT \'1\' NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_C6BD3229696D2EBB (parent_region_id), INDEX IDX_C6BD3229C54C8C93 (type_id), INDEX IDX_C6BD3229F92F3E70 (country_id), INDEX IDX_C6BD3229E946114A (province_id), INDEX IDX_C6BD32298BAC62AF (city_id), INDEX IDX_C6BD322998260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE city (id INT UNSIGNED AUTO_INCREMENT NOT NULL, province_id INT UNSIGNED NOT NULL, name_ VARCHAR(100) NOT NULL, category VARCHAR(30) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, INDEX IDX_2D5B0234E946114A (province_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language_ (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_ VARCHAR(100) NOT NULL, iso_code VARCHAR(10) NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE address_type (id INT UNSIGNED AUTO_INCREMENT NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, name_ VARCHAR(100) NOT NULL, slug VARCHAR(30) NOT NULL, INDEX slug_idx (slug), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE country (id INT UNSIGNED AUTO_INCREMENT NOT NULL, name_ VARCHAR(100) NOT NULL, alpha2Code VARCHAR(5) NOT NULL, alpha3Code VARCHAR(5) NOT NULL, numericCode SMALLINT UNSIGNED NOT NULL, created_date DATETIME NOT NULL, modified_date DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A647930A1DE10 FOREIGN KEY (number_id) REFERENCES phone_number (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479E559DFD1 FOREIGN KEY (locale_id) REFERENCES locale (id)');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A64793FE997DE FOREIGN KEY (timezone_id) REFERENCES timezone (id)');
        $this->addSql('ALTER TABLE users_companies ADD CONSTRAINT FK_E439D0DBA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_companies ADD CONSTRAINT FK_E439D0DB979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE users_numbers ADD CONSTRAINT FK_879EBE33A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE users_numbers ADD CONSTRAINT FK_879EBE3330A1DE10 FOREIGN KEY (number_id) REFERENCES phone_number (id)');
        $this->addSql('ALTER TABLE users_email_addresses ADD CONSTRAINT FK_DBB415A7A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE users_email_addresses ADD CONSTRAINT FK_DBB415A759045DAA FOREIGN KEY (email_address_id) REFERENCES email_address (id)');
        $this->addSql('ALTER TABLE users_addresses ADD CONSTRAINT FK_9B70FF7A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE users_addresses ADD CONSTRAINT FK_9B70FF7F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F6BF700BD FOREIGN KEY (status_id) REFERENCES company_status (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F30A1DE10 FOREIGN KEY (number_id) REFERENCES phone_number (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094F59045DAA FOREIGN KEY (email_address_id) REFERENCES email_address (id)');
        $this->addSql('ALTER TABLE company ADD CONSTRAINT FK_4FBF094FF5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE companies_types ADD CONSTRAINT FK_BAB9C6D4979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE companies_types ADD CONSTRAINT FK_BAB9C6D4C54C8C93 FOREIGN KEY (type_id) REFERENCES company_type (id)');
        $this->addSql('ALTER TABLE companies_numbers ADD CONSTRAINT FK_ABEF4399979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE companies_numbers ADD CONSTRAINT FK_ABEF439930A1DE10 FOREIGN KEY (number_id) REFERENCES phone_number (id)');
        $this->addSql('ALTER TABLE companies_email_addresses ADD CONSTRAINT FK_21DFA99B979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE companies_email_addresses ADD CONSTRAINT FK_21DFA99B59045DAA FOREIGN KEY (email_address_id) REFERENCES email_address (id)');
        $this->addSql('ALTER TABLE companies_addresses ADD CONSTRAINT FK_9E53F944979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE companies_addresses ADD CONSTRAINT FK_9E53F944F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id)');
        $this->addSql('ALTER TABLE phone_number ADD CONSTRAINT FK_6B01BC5BC54C8C93 FOREIGN KEY (type_id) REFERENCES phone_number_type (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81C54C8C93 FOREIGN KEY (type_id) REFERENCES address_type (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81E946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F818BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE locale ADD CONSTRAINT FK_4180C69882F1BAF4 FOREIGN KEY (language_id) REFERENCES language_ (id)');
        $this->addSql('ALTER TABLE locale ADD CONSTRAINT FK_4180C698F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE company_rep ADD CONSTRAINT FK_E4480F9A979B1AD6 FOREIGN KEY (company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE company_rep ADD CONSTRAINT FK_E4480F9AA76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE company_rep ADD CONSTRAINT FK_E4480F9A7CF2797 FOREIGN KEY (client_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE company_rep ADD CONSTRAINT FK_E4480F9AF55397E8 FOREIGN KEY (client_user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE company_tree ADD CONSTRAINT FK_F453443232D8BDA7 FOREIGN KEY (root_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE company_tree ADD CONSTRAINT FK_F4534432D0D89E86 FOREIGN KEY (parent_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE company_tree ADD CONSTRAINT FK_F45344327344E4BD FOREIGN KEY (child_company_id) REFERENCES company (id)');
        $this->addSql('ALTER TABLE province ADD CONSTRAINT FK_4ADAD40BF92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE region_item ADD CONSTRAINT FK_C6BD3229696D2EBB FOREIGN KEY (parent_region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE region_item ADD CONSTRAINT FK_C6BD3229C54C8C93 FOREIGN KEY (type_id) REFERENCES region_item_type (id)');
        $this->addSql('ALTER TABLE region_item ADD CONSTRAINT FK_C6BD3229F92F3E70 FOREIGN KEY (country_id) REFERENCES country (id)');
        $this->addSql('ALTER TABLE region_item ADD CONSTRAINT FK_C6BD3229E946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE region_item ADD CONSTRAINT FK_C6BD32298BAC62AF FOREIGN KEY (city_id) REFERENCES city (id)');
        $this->addSql('ALTER TABLE region_item ADD CONSTRAINT FK_C6BD322998260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE city ADD CONSTRAINT FK_2D5B0234E946114A FOREIGN KEY (province_id) REFERENCES province (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE users_companies DROP FOREIGN KEY FK_E439D0DBA76ED395');
        $this->addSql('ALTER TABLE users_numbers DROP FOREIGN KEY FK_879EBE33A76ED395');
        $this->addSql('ALTER TABLE users_email_addresses DROP FOREIGN KEY FK_DBB415A7A76ED395');
        $this->addSql('ALTER TABLE users_addresses DROP FOREIGN KEY FK_9B70FF7A76ED395');
        $this->addSql('ALTER TABLE company_rep DROP FOREIGN KEY FK_E4480F9AA76ED395');
        $this->addSql('ALTER TABLE company_rep DROP FOREIGN KEY FK_E4480F9AF55397E8');
        $this->addSql('ALTER TABLE users_companies DROP FOREIGN KEY FK_E439D0DB979B1AD6');
        $this->addSql('ALTER TABLE companies_types DROP FOREIGN KEY FK_BAB9C6D4979B1AD6');
        $this->addSql('ALTER TABLE companies_numbers DROP FOREIGN KEY FK_ABEF4399979B1AD6');
        $this->addSql('ALTER TABLE companies_email_addresses DROP FOREIGN KEY FK_21DFA99B979B1AD6');
        $this->addSql('ALTER TABLE companies_addresses DROP FOREIGN KEY FK_9E53F944979B1AD6');
        $this->addSql('ALTER TABLE company_rep DROP FOREIGN KEY FK_E4480F9A979B1AD6');
        $this->addSql('ALTER TABLE company_rep DROP FOREIGN KEY FK_E4480F9A7CF2797');
        $this->addSql('ALTER TABLE company_tree DROP FOREIGN KEY FK_F453443232D8BDA7');
        $this->addSql('ALTER TABLE company_tree DROP FOREIGN KEY FK_F4534432D0D89E86');
        $this->addSql('ALTER TABLE company_tree DROP FOREIGN KEY FK_F45344327344E4BD');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A647930A1DE10');
        $this->addSql('ALTER TABLE users_numbers DROP FOREIGN KEY FK_879EBE3330A1DE10');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F30A1DE10');
        $this->addSql('ALTER TABLE companies_numbers DROP FOREIGN KEY FK_ABEF439930A1DE10');
        $this->addSql('ALTER TABLE users_email_addresses DROP FOREIGN KEY FK_DBB415A759045DAA');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F59045DAA');
        $this->addSql('ALTER TABLE companies_email_addresses DROP FOREIGN KEY FK_21DFA99B59045DAA');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479F5B7AF75');
        $this->addSql('ALTER TABLE users_addresses DROP FOREIGN KEY FK_9B70FF7F5B7AF75');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094FF5B7AF75');
        $this->addSql('ALTER TABLE companies_addresses DROP FOREIGN KEY FK_9E53F944F5B7AF75');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479E559DFD1');
        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A64793FE997DE');
        $this->addSql('ALTER TABLE company DROP FOREIGN KEY FK_4FBF094F6BF700BD');
        $this->addSql('ALTER TABLE companies_types DROP FOREIGN KEY FK_BAB9C6D4C54C8C93');
        $this->addSql('ALTER TABLE phone_number DROP FOREIGN KEY FK_6B01BC5BC54C8C93');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81E946114A');
        $this->addSql('ALTER TABLE region_item DROP FOREIGN KEY FK_C6BD3229E946114A');
        $this->addSql('ALTER TABLE city DROP FOREIGN KEY FK_2D5B0234E946114A');
        $this->addSql('ALTER TABLE region_item DROP FOREIGN KEY FK_C6BD3229C54C8C93');
        $this->addSql('ALTER TABLE region_item DROP FOREIGN KEY FK_C6BD3229696D2EBB');
        $this->addSql('ALTER TABLE region_item DROP FOREIGN KEY FK_C6BD322998260155');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F818BAC62AF');
        $this->addSql('ALTER TABLE region_item DROP FOREIGN KEY FK_C6BD32298BAC62AF');
        $this->addSql('ALTER TABLE locale DROP FOREIGN KEY FK_4180C69882F1BAF4');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81C54C8C93');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81F92F3E70');
        $this->addSql('ALTER TABLE locale DROP FOREIGN KEY FK_4180C698F92F3E70');
        $this->addSql('ALTER TABLE province DROP FOREIGN KEY FK_4ADAD40BF92F3E70');
        $this->addSql('ALTER TABLE region_item DROP FOREIGN KEY FK_C6BD3229F92F3E70');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE users_companies');
        $this->addSql('DROP TABLE users_numbers');
        $this->addSql('DROP TABLE users_email_addresses');
        $this->addSql('DROP TABLE users_addresses');
        $this->addSql('DROP TABLE company');
        $this->addSql('DROP TABLE companies_types');
        $this->addSql('DROP TABLE companies_numbers');
        $this->addSql('DROP TABLE companies_email_addresses');
        $this->addSql('DROP TABLE companies_addresses');
        $this->addSql('DROP TABLE phone_number');
        $this->addSql('DROP TABLE email_address');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE locale');
        $this->addSql('DROP TABLE timezone');
        $this->addSql('DROP TABLE company_rep');
        $this->addSql('DROP TABLE company_tree');
        $this->addSql('DROP TABLE company_status');
        $this->addSql('DROP TABLE company_type');
        $this->addSql('DROP TABLE phone_number_type');
        $this->addSql('DROP TABLE province');
        $this->addSql('DROP TABLE region_item_type');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE region_item');
        $this->addSql('DROP TABLE city');
        $this->addSql('DROP TABLE language_');
        $this->addSql('DROP TABLE address_type');
        $this->addSql('DROP TABLE country');
    }
}
