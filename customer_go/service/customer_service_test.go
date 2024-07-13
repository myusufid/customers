package service

import (
	"context"
	"customer_go/mocks"
	"customer_go/model"
	"github.com/stretchr/testify/assert"
	"github.com/stretchr/testify/mock"
	"testing"
)

func TestGetCustomerDetail(t *testing.T) {
	mockRepo := new(mocks.MockCustomerRepository)
	svc := NewCustomerService(mockRepo)

	mockCustomer := model.Customer{
		CstID:       1,
		CstName:     "test",
		CstDOB:      "1982-01-01",
		CstPhoneNum: "628212818",
		CstEmail:    "test@gmail.com",
	}

	mockRepo.On("GetCustomerDetail", mock.Anything, int64(1)).Return(mockCustomer, nil)

	customer, err := svc.GetCustomerDetail(context.Background(), 1)

	assert.NoError(t, err)
	assert.Equal(t, "test", customer.CstName)
	mockRepo.AssertExpectations(t)
}
