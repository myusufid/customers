package main

import (
	"customer_go/handler"
	"customer_go/repository"
	"customer_go/service"
	"database/sql"
	_ "github.com/go-sql-driver/mysql"
	"github.com/gorilla/mux"
	"log"
	"net/http"
)

func main() {
	db, err := sql.Open("mysql", "app:secret@tcp(localhost:3306)/laravel")
	if err != nil {
		log.Fatal(err)
	}
	defer db.Close()

	customerRepo := repository.NewCustomerRepository(db)
	customerService := service.NewCustomerService(customerRepo)
	customerHandler := handler.NewCustomerHandler(customerService)

	r := mux.NewRouter()
	r.HandleFunc("/customers/{id}", customerHandler.GetCustomerDetail).Methods("GET")

	log.Fatal(http.ListenAndServe(":3000", r))
}
