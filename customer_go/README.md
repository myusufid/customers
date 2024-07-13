
## Setup

Install dependencies:
```sh 
go mod tidy
```    

    
##  Run 
1. Edit DSN `db, err := sql.Open("mysql", "app:secret@tcp(localhost:3306)/laravel")`
2. go run `cmd/main.go`

## How to test
```sh 
    make test
```

    