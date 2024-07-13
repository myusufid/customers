package mocks

import (
	"context"
	"customer_go/model"
	"github.com/stretchr/testify/mock"
)

type MockCustomerRepository struct {
	mock.Mock
}

func (m *MockCustomerRepository) GetCustomerDetail(ctx context.Context, id int64) (model.Customer, error) {
	args := m.Called(ctx, id)
	return args.Get(0).(model.Customer), args.Error(1)
}
