package repository

import (
	"context"
	"customer_go/model"
	"database/sql"
)

type CustomerRepository interface {
	GetCustomerDetail(ctx context.Context, id int64) (model.Customer, error)
}

type customerRepository struct {
	db *sql.DB
}

func NewCustomerRepository(db *sql.DB) CustomerRepository {
	return &customerRepository{db: db}
}

func (r *customerRepository) GetCustomerDetail(ctx context.Context, id int64) (model.Customer, error) {
	var customer model.Customer

	customerQuery := `
    SELECT c.cst_id, c.cst_name, c.cst_dob, c.cst_phoneNum, c.cst_email, n.nationality_name, n.nationality_code
    FROM customer c
    LEFT JOIN nationality n ON c.nationality_id = n.nationality_id
    WHERE c.cst_id = ?`

	err := r.db.QueryRowContext(ctx, customerQuery, id).Scan(
		&customer.CstID,
		&customer.CstName,
		&customer.CstDOB,
		&customer.CstPhoneNum,
		&customer.CstEmail,
		&customer.Nationality.NationalityName,
		&customer.Nationality.NationalityCode,
	)
	if err != nil {
		return customer, err
	}

	familyQuery := `
    SELECT f.fl_id, f.cst_id, f.fl_relation, f.fl_name, f.fl_dob
    FROM family_list f
    WHERE f.cst_id = ?`

	rows, err := r.db.QueryContext(ctx, familyQuery, id)
	if err != nil {
		return customer, err
	}
	defer rows.Close()

	for rows.Next() {
		var family model.Family
		if err := rows.Scan(
			&family.FLID,
			&family.CstID,
			&family.FLRelation,
			&family.FLName,
			&family.FLDOB,
		); err != nil {
			return customer, err
		}
		customer.FamilyList = append(customer.FamilyList, family)
	}

	return customer, nil
}
