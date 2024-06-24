document.addEventListener('DOMContentLoaded', function() {
    // Function to fetch and display product details
    function fetchProductDetails() {
        const urlParams = new URLSearchParams(window.location.search);
        const productId = urlParams.get('product_id');

        fetch(`get_product_detailsAdmin.php?product_id=${productId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Update DOM with fetched product details
                if (data && data.product_name) {
                    document.getElementById('product-title').textContent = data.product_name;
                    document.getElementById('product-img').src = data.image_url;
                    document.getElementById('price').textContent = `RM ${data.price}`;
                    document.getElementById('discounted-price').textContent = `RM ${data.discounted_price}`;
                    document.getElementById('product-details').textContent = data.description;
                    document.getElementById('availability').textContent = data.availability ? 'In Stock' : 'Out of Stock';
                    document.getElementById('rating').textContent = data.rating;
                } else {
                    console.error('Invalid data received from server');
                }
            })
            .catch(error => {
                console.error('Error fetching product details:', error);
            });
    }

    // Call the function to fetch product details when the page loads
    fetchProductDetails();
});
