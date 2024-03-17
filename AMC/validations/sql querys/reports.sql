CREATE TABLE reports (
    report_id INT AUTO_INCREMENT PRIMARY KEY,
    company_id VARCHAR(12),
    report_type VARCHAR(255) NOT NULL,
    report_description TEXT NOT NULL,
    report_timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (company_id) REFERENCES amc_users(company_id)
);
