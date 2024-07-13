package service

import (
	"context"
	"customer_go/model"
	"customer_go/repository"
)

type CustomerService interface {
	GetCustomerDetail(ctx context.Context, id int64) (model.Customer, error)
}

type customerService struct {
	repo repository.CustomerRepository
}

func NewCustomerService(repo repository.CustomerRepository) CustomerService {
	return &customerService{repo: repo}
}

func (s *customerService) GetCustomerDetail(ctx context.Context, id int64) (model.Customer, error) {
	customer, err := s.repo.GetCustomerDetail(ctx, id)
	if err != nil {
		return model.Customer{}, err
	}

	customer.Nationality.NationalityName = customer.Nationality.NationalityName + " (" + customer.Nationality.NationalityCode + ")"
	return customer, nil
}
