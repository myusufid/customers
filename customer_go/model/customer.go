package model

type Customer struct {
	CstID         int64       `json:"cst_id"`
	NationalityID int64       `json:"nationality_id"`
	CstName       string      `json:"cst_name"`
	CstDOB        string      `json:"cst_dob"`
	CstPhoneNum   string      `json:"cst_phoneNum"`
	CstEmail      string      `json:"cst_email"`
	FamilyList    []Family    `json:"family_list"`
	Nationality   Nationality `json:"nationality"`
}

type Family struct {
	FLID       int64  `json:"-"`
	CstID      int64  `json:"-"`
	FLRelation string `json:"hubungan"`
	FLName     string `json:"nama"`
	FLDOB      string `json:"tanggal_lahir"`
}

type Nationality struct {
	NationalityID   int64  `json:"nationality_id"`
	NationalityName string `json:"nationality_name"`
	NationalityCode string `json:"nationality_code"`
}
