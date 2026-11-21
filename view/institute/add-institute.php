<?php include '../../model/db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add New Institute</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background: linear-gradient(135deg, #f6f8f8, #f9fafc);
    font-family: 'Segoe UI', sans-serif;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}

.card-form {
    background: #f7f7f7cc;
    border-radius: 1rem;                                                                        
    box-shadow: 0 12px 35px rgba(0,0,0,0.2);
    width: 100%;
    max-width: 600px;
    overflow: hidden;
}

.card-header-form {
    background: linear-gradient(90deg, #0072ff, #00c6ff);
    color: white;
    font-weight: 600;
    font-size: 1.4rem;
    text-align: center;
    padding: 1.2rem;
}

.card-body-form {
    padding: 2rem;
}

.form-control-custom {
    border-radius: 0.5rem;
    padding: 12px 15px;
    font-size: 1rem;
    border: 1px solid #d0d0d0;
    transition: 0.3s;
}
.form-control-custom:focus {
    border-color: #f4f6f8;
    box-shadow: 0 0 8px rgba(0,114,255,0.3);
    outline: none;
}

.btn-submit {
    background: linear-gradient(90deg, #fa105e, #fa3b3b);
    color: white;
    border: none;
    font-weight: 600;
    border-radius: 0.5rem;
    padding: 12px;
    font-size: 1.1rem;
    transition: all 0.3s;
}
.btn-submit:hover {
    background: linear-gradient(90deg, #f3f4f5, #f8f9fa);
    transform: translateY(-2px);
}

@media(max-width: 600px){
    .card-body-form {
        padding: 1.5rem;
    }
}
</style>
</head>
<body>

<div class="card-form">
    <div class="card-header-form">
        Add New Institute
    </div>
    <div class="card-body-form">
        <form action="institutecontroller.php" method="POST" enctype="multipart/form-data">

            <div class="mb-3">
                <label class="form-label fw-semibold">Institute Name</label>
                <input type="text" name="name" class="form-control form-control-custom" placeholder="Enter institute name" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Region</label>
                <input type="text" name="region" class="form-control form-control-custom" placeholder="Enter region" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control form-control-custom" rows="4" placeholder="Brief description about the institute" required></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Institute Image</label>
                <input type="file" name="image" class="form-control form-control-custom" required>
            </div>

            <div class="d-grid">
                <button type="submit" name="add_institute" class="btn btn-submit">
                    Add Institute
                </button>
            </div>

        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>