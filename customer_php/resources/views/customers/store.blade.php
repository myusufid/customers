<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Form</title>
    <!-- Add Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 50%;
            margin: auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2, h3 {
            margin-top: 0;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        #familyList > div {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        #familyList input[type="text"], #familyList input[type="date"] {
            flex: 1;
            margin-right: 10px;
        }
        #familyList button {
            padding: 10px 20px;
            background: #e74c3c;
            border: none;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        #addFamilyBtn {
            background: #3498db;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #addFamilyBtn:hover, #familyList button:hover {
            opacity: 0.9;
        }
    </style>
</head>
<body>
<div class="container bg-white p-3 rounded mt-5 col-lg-6">
    <h2 class="fw-bold">USER</h2>
    <form id="userForm" action="{{route('customers.store')}}" method="POST" >
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" class="form-control form-style" id="name" name="name" placeholder="Masukan nama anda">

            @error('name')
            <div style="color: red; font-weight: bold;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Telepon</label>
            <input type="text" class="form-control form-style" id="phone" name="phone" placeholder="Masukan No HP anda">

            @error('phone')
            <div style="color: red; font-weight: bold;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Email</label>
            <input type="email" class="form-control form-style" id="email" name="email" placeholder="Masukan Email anda">

            @error('email')
            <div style="color: red; font-weight: bold;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="dob" class="form-label">Tanggal Lahir</label>
            <input type="date" class="form-control form-style" id="dob" name="dob" placeholder="Pilih tanggal">
            @error('dob')
            <div style="color: red; font-weight: bold;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="nationality" class="form-label">Kewarganegaraan</label>
            <select class="form-control form-style" id="nationality" name="nationality">
                <option value="">Select your nationality</option>
                @foreach($nationalities as $nationality)
                    <option value="{{$nationality->nationality_id}}">{{$nationality->nationality_name}}</option>
                @endforeach
            </select>
            @error('nationality')
            <div style="color: red; font-weight: bold;">
                {{ $message }}
            </div>
            @enderror
        </div>
        <h3 class="fw-bold">Keluarga</h3>
        <button type="button" class="btn mt-3 add-button" id="addFamilyBtn">+ Tambah Keluarga</button>
        <div id="familyList"></div>
        @error('family')
        <div style="color: red; font-weight: bold;">
            {{ $message }}
        </div>
        @enderror

        <button type="submit" class="btn btn-primary mt-3" id="saveBtn">Simpan</button>
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const familyList = document.getElementById('familyList');
        const addFamilyBtn = document.getElementById('addFamilyBtn');
        addFamilyBtn.addEventListener('click', () => {
            addFamilyMember();
        });
        function addFamilyMember() {
            let index = familyList.children.length;
            const familyMemberDiv = document.createElement('div');
            familyMemberDiv.className = 'form-group';

            const nameInput = document.createElement('input');
            nameInput.type = 'text';
            nameInput.className = 'form-control form-style mt-3';
            nameInput.placeholder = 'Masukan Nama';
            nameInput.name = 'family['+index+'][family_name]';

            const relationInput = document.createElement('input');
            relationInput.type = 'text';
            relationInput.className = 'form-control form-style mt-3';
            relationInput.placeholder = 'Masukan Hubungan';
            relationInput.name = 'family['+index+'][family_relation]';


            const dobInput = document.createElement('input');
            dobInput.type = 'date';
            dobInput.className = 'form-control form-style mt-3';
            dobInput.placeholder = 'Pilih tanggal';
            dobInput.name = 'family['+index+'][family_dob]';
            const deleteBtn = document.createElement('button');
            deleteBtn.className = 'btn delete-button mt-3';
            deleteBtn.textContent = 'Hapus';
            deleteBtn.addEventListener('click', () => {
                familyList.removeChild(familyMemberDiv);
            });
            familyMemberDiv.appendChild(nameInput);
            familyMemberDiv.appendChild(relationInput);
            familyMemberDiv.appendChild(dobInput);
            familyMemberDiv.appendChild(deleteBtn);
            familyList.appendChild(familyMemberDiv);
        }
    });
</script>
</body>
</html>
