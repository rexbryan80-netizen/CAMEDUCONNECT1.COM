<?php
include("../../model/db.php");
include ( "expertcontroller.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Expert</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(135deg, #f8f8faff, #f7eeefff);
        font-family: 'Poppins', sans-serif;
    }

    .form-card {
        max-width: 850px;
        width: 90%;
        background: #ffffffdd;
        border-radius: 1.5rem;
        box-shadow: 0 20px 50px rgba(0,0,0,0.25);
        padding: 2rem;
    }

    .form-header {
        text-align: center;
        font-size: 1.8rem;
        font-weight: 700;
        color: #fff;
        padding: 1rem;
        border-radius: 1rem 1rem 0 0;
        background: linear-gradient(90deg, #ff416c, #ff4b2b);
        margin: -2rem -2rem 2rem -2rem;
    }

    .form-lg {
        padding: 12px 18px;
        font-size: 1.05rem;
        border-radius: 0.5rem;
    }

    .btn-gradient {
        background: linear-gradient(90deg, #ff416c, #ff4b2b);
        color: white;
        border: none;
        border-radius: 0.5rem;
        font-size: 1.2rem;
        padding: 12px 0;
        font-weight: 600;
    }

    .info-text {
        font-size: 0.9rem;
        color: #555;
        margin-top: -10px;
        margin-bottom: 15px;
    }
</style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="form-card">
        <div class="form-header">Add New Expert</div>

        <form method="POST" enctype="multipart/form-data" action="expertcontroller.php">

            <div class="mb-3">
                <label class="form-label fw-semibold">Full Name</label>
                <input type="text" name="full_name" class="form-control form-lg" placeholder="Enter full name" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control form-lg" placeholder="Enter email address" required>
                <div class="info-text">
                    A password will be automatically generated and sent to this email.
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Phone</label>
                <input type="text" name="phone" class="form-control form-lg" placeholder="Enter phone number">
            </div>

            <!-- ❌ PASSWORD FIELD REMOVED -->

            <div class="mb-3">
                <label class="form-label fw-semibold">Region</label>
                <select name="region" class="form-select form-lg" required>
                    <option value="">Select Region</option>
                    <option>Centre</option>
                    <option>Littoral</option>
                    <option>South West</option>
                    <option>North West</option>
                    <option>West</option>
                    <option>East</option>
                    <option>North</option>
                    <option>Far North</option>
                    <option>Adamawa</option>
                    <option>South</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Specialization</label>
                <input type="text" name="specialization" class="form-control form-lg" placeholder="Enter specialization">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Qualification</label>
                <input type="text" name="qualification" class="form-control form-lg" placeholder="Enter qualification">
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Profile Image</label>
                <input type="file" name="profile_image" class="form-control form-lg">
            </div>

            <div class="d-grid">
                <button type="submit" name="add_expert" class="btn btn-gradient">
                    Add Expert
                </button>
            </div>

        </form>
    </div>
</div>

</body>
</html>