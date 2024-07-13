<?php

use App\Models\Customer;
use App\Models\Nationality;

it('can display the customers index', function () {
    $response = $this->get(route('customers.index'));

    $response->assertOk();
});

it('can create a new customer', function () {
    $nationality = Nationality::factory()->create();
    $customerData = [
        'name' => 'test',
        'email' => 'test@email.com',
        'phone' => '0823123123',
        'dob' => "2024-07-31",
        'nationality' => $nationality->id
    ];
    $this->post(route('customers.store'), $customerData)
        ->assertRedirect(route('customers.index'));

    $this->assertDatabaseHas('customer', [
        'cst_name' => 'test'
    ]);
});

it('can update the customer', function () {
    $customer = Customer::factory()->create();
    $nationality = Nationality::factory()->create();
    $updatedCustomerData = [
        'name' => 'test',
        'email' => 'test@email.com',
        'phone' => '0823123123',
        'dob' => "2024-07-31",
        'nationality' => $nationality->id
    ];

    $this->put(route('customers.update', $customer), $updatedCustomerData)
        ->assertRedirect(route('customers.index'));

    $this->assertDatabaseHas('customer', [
        'cst_name' => 'test'
    ]);
});

it('can delete the customer', function () {
    $customer = Customer::factory()->create();

    $this->delete(route('customers.destroy', $customer))
        ->assertRedirect(route('customers.index'));

    $this->assertDeleted($customer);
});
