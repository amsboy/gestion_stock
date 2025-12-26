document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Sample data for demonstration
    const dashboardData = {
        dailySales: 0,
        totalStock: 0,
        stockAlerts: 0
    };

    // Update dashboard cards
    document.querySelectorAll('.bg-white.rounded-lg.shadow p.text-3xl')[0].textContent = dashboardData.dailySales;
    document.querySelectorAll('.bg-white.rounded-lg.shadow p.text-3xl')[1].textContent = dashboardData.totalStock;
    document.querySelectorAll('.bg-white.rounded-lg.shadow p.text-3xl')[2].textContent = dashboardData.stockAlerts;
});

// Form validation for product and sales forms
function validateProductForm() {
    const name = document.getElementById('productName').value;
    const price = document.getElementById('productPrice').value;
    const stock = document.getElementById('productStock').value;
    
    if (!name || !price || !stock) {
        alert('Veuillez remplir tous les champs obligatoires');
        return false;
    }
    return true;
}

function validateSaleForm() {
    const product = document.getElementById('saleProduct').value;
    const quantity = document.getElementById('saleQuantity').value;
    
    if (!product || !quantity) {
        alert('Veuillez sélectionner un produit et une quantité');
        return false;
    }
    return true;
}