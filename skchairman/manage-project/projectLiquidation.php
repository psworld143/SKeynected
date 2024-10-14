<?php
require_once '../core/projectController.php';
$projectController = new projectController();
$user_id = $_SESSION['id'] ?? null;
$projects = $projectController->getProjects($user_id);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Project Liquidation</title>
    <meta content="Project Management Dashboard" name="description">
    <meta content="projects, management, dashboard" name="keywords">

    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
    <link href="../assets/css/globalss.css" rel="stylesheet">
</head>

<body>
    <?php
    include_once '../partials/navbar.php';
    include_once '../partials/sidebar.php';
    ?>

    <main id="main" class="main" style="margin-top: 100px;">
        <div class="pagetitle">
            <h1>Project Liquidation</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Project Liquidation</li>
                </ol>
            </nav>
        </div>

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Liquidate Your Project</h5>
                            <form id="liquidationForm">
                                <div class="col-md-5">
                                    <div class="mb-4">
                                        <label for="projectSelect" class="form-label">Select Project</label>
                                        <select class="form-select" id="projectSelect" required>
                                            <option value="" disabled selected>Choose a project...</option>
                                            <?php foreach ($projects as $project): ?>
                                                <option value="<?php echo $project['project_id']; ?>"><?php echo htmlspecialchars($project['project_name']); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div id="liquidationDetails" style="display: none;">
                                        <div class="mb-3">
                                            <label class="form-label">Materials</label>
                                            <div id="materialsList" class="border p-3" style="background-color: #f9f9f9; border-radius: 5px;"></div>
                                        </div>

                                        <div class="mb-4">
                                            <label for="receipt" class="form-label">Receipt</label>
                                            <textarea id="receipt" class="form-control" rows="5" readonly></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <strong>Total Cost: </strong><span id="totalCost">₱0.00</span>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Submit Liquidation</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const projectSelect = document.getElementById('projectSelect');
            const liquidationDetails = document.getElementById('liquidationDetails');
            const materialsList = document.getElementById('materialsList');
            const liquidationForm = document.getElementById('liquidationForm');
            const receiptTextarea = document.getElementById('receipt');
            const totalCostDisplay = document.getElementById('totalCost');

            let totalCost = 0;

            projectSelect.addEventListener('change', function() {
                if (this.value) {
                    liquidationDetails.style.display = 'block';
                    loadMaterials(this.value);
                } else {
                    liquidationDetails.style.display = 'none';
                }
            });

            liquidationForm.addEventListener('submit', function(e) {
                e.preventDefault();
                submitLiquidation();
            });

            function loadMaterials(projectId) {
                fetch(`get_materials.php?project_id=${projectId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! status: ${response.status}`);
                        }
                        return response.text();
                    })
                    .then(data => {
                        console.log('Raw response data:', data);
                        try {
                            const jsonData = JSON.parse(data);
                            if (jsonData.error) {
                                throw new Error(jsonData.error);
                            }
                            if (jsonData.success && Array.isArray(jsonData.materials)) {
                                materialsList.innerHTML = '';
                                jsonData.materials.forEach(material => addMaterialRow(material));
                                updateTotalCost();
                            } else {
                                throw new Error('Invalid response format');
                            }
                        } catch (error) {
                            throw new Error('Failed to parse JSON: ' + error.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        materialsList.innerHTML = `<p class="text-danger">Error loading materials: ${error.message}</p>`;
                    });
            }

            function addMaterialRow(material) {
                const row = document.createElement('div');
                row.className = 'row mb-2';
                row.innerHTML = `
                <div class="col-md-3">
                    <input type="hidden" class="form-control" value="${material.material_id || ''}" readonly>
                    <input type="hidden" class="form-control" value="${material.project_id || ''}" readonly>
                    <label class="form-label">Material</label>
                    <input type="text" class="form-control" value="${material.material_name || ''}" readonly>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Quantity</label>
                    <input type="number" class="form-control quantity" placeholder="Quantity" required max="${material.quantity}" min="0" value="${material.quantity || 0}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Amount</label>
                    <input type="number" class="form-control amount" value="${material.amount || 0}" readonly>
                </div>
                <div class="col-md-3">
                    <label class="form-label">OR Number</label>
                    <input type="text" class="form-control or-number" placeholder="OR Number" value="${material.or_number || ''}" readonly>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Upload OR</label>
                    <input type="file" class="form-control material-image" name="or_image" accept="image/jpeg, image/png">
                </div>
            `;
                materialsList.appendChild(row);

                const quantityInput = row.querySelector('.quantity');
                quantityInput.addEventListener('input', function() {
                    if (parseInt(this.value) > parseInt(this.max)) {
                        this.value = this.max;
                    }
                    updateTotalCost();
                });

                const orNumberInput = row.querySelector('.or-number');
                orNumberInput.addEventListener('input', updateReceipt);
            }

            function updateTotalCost() {
                totalCost = 0;
                const rows = materialsList.querySelectorAll('.row');

                rows.forEach(row => {
                    const quantity = row.querySelector('.quantity').value;
                    const amount = row.querySelector('.amount').value;
                    totalCost += (parseInt(quantity) || 0) * (parseFloat(amount) || 0);
                });

                totalCostDisplay.value = totalCost.toFixed(2);
                updateReceipt();
            }

            function updateReceipt() {
                let receiptContent = 'Receipt:\n\n';
                const rows = materialsList.querySelectorAll('.row');

                rows.forEach(row => {
                    const materialName = row.querySelector('input[type="text"]').value.trim();
                    const quantity = row.querySelector('.quantity').value;
                    const amount = row.querySelector('.amount').value;
                    const orNumber = row.querySelector('.or-number').value.trim();
                    if (quantity && orNumber) {
                        receiptContent += `Material: ${materialName}, Quantity: ${quantity}, Amount: ${amount}, OR Number: ${orNumber}\n`;
                    }
                });

                receiptContent += `\nTotal Cost: ${totalCost.toFixed(2)}`;
                receiptTextarea.value = receiptContent;
            }

            function submitLiquidation() {
                const projectId = projectSelect.value;
                const formData = new FormData();
                const materials = [];
                const rows = materialsList.querySelectorAll('.row');

                rows.forEach((row, index) => {
                    const materialId = row.querySelector('input[type="hidden"][value]').value;
                    const projectId = row.querySelector('input[type="hidden"]:nth-child(2)').value;
                    const materialName = row.querySelector('input[type="text"]').value.trim();
                    const quantity = row.querySelector('.quantity').value;
                    const amount = row.querySelector('.amount').value;
                    const orNumber = row.querySelector('.or-number').value.trim();
                    const fileInput = row.querySelector('.material-image');
                    const file = fileInput.files[0];

                    const materialData = {
                        materialId: materialId,
                        projectId: projectId,
                        name: materialName,
                        quantity: quantity,
                        amount: amount,
                        orNumber: orNumber
                    };

                    materials.push(materialData);

                    if (file) {
                        formData.append(`orImage_${index}`, file);
                    }
                });

                formData.append('projectId', projectId);
                formData.append('materials', JSON.stringify(materials));
                formData.append('totalCost', totalCost);

                submitData(formData);
            }

            function submitData(formData) {
                fetch('submitLiquidation.php', {
                        method: 'POST',
                        body: formData,
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('Liquidation submitted successfully!');
                            // Reset form
                            liquidationForm.reset();
                            totalCostDisplay.value = "0.00";
                            receiptTextarea.value = '';
                            materialsList.innerHTML = '';
                            liquidationDetails.style.display = 'none';
                        } else {
                            alert(`Error: ${data.message}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to submit liquidation. Please try again.');
                    });
            }


        });
    </script>

</body>

</html>