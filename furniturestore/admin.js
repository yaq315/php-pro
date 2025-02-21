document.addEventListener("DOMContentLoaded", function () {
    // Ensure the canvas elements exist before initializing charts
    const salesChartElem = document.getElementById('salesChart');
    const ordersChartElem = document.getElementById('ordersChart');

    if (salesChartElem && ordersChartElem) {
        // Sales Chart using Chart.js
        const salesChartCtx = salesChartElem.getContext('2d');
        const salesChart = new Chart(salesChartCtx, {
            type: 'line',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Sales',
                    data: [5000, 7000, 4500, 8000, 6000, 9000],
                    backgroundColor: 'rgba(139, 115, 85, 0.2)',
                    borderColor: '#8B7355',
                    borderWidth: 2,
                    pointBackgroundColor: '#8B7355', // Adding color to data points
                    fill: true
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 1000, // Adding animation for the chart
                    easing: 'easeOutBounce'
                },
                plugins: {
                    tooltip: {
                        enabled: true, // Enabling tooltip on hover
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });

        // Orders Chart using Chart.js
        const ordersChartCtx = ordersChartElem.getContext('2d');
        const ordersChart = new Chart(ordersChartCtx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June'],
                datasets: [{
                    label: 'Orders',
                    data: [20, 35, 25, 40, 30, 50],
                    backgroundColor: 'rgba(139, 115, 85, 0.5)',
                    borderColor: '#8B7355',
                    borderWidth: 1,
                    hoverBackgroundColor: 'rgba(139, 115, 85, 0.8)' // Hover effect
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                animation: {
                    duration: 1000, // Adding animation for the chart
                    easing: 'easeOutBounce'
                },
                plugins: {
                    tooltip: {
                        enabled: true, // Enabling tooltip on hover
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });
    } else {
        console.error("Canvas elements not found!");
    }

    // Adding scroll effects for sidebar and main content
    window.addEventListener('scroll', () => {
        const sidebar = document.querySelector('.sidebar');
        const mainContent = document.querySelector('.content');
        
        if (window.scrollY > 100) {
            sidebar.classList.add('scrolled');
            mainContent.classList.add('scrolled');
        } else {
            sidebar.classList.remove('scrolled');
            mainContent.classList.remove('scrolled');
        }
    });

    // Smooth scrolling on links in the sidebar
    const sidebarLinks = document.querySelectorAll('.sidebar nav ul li a');
    sidebarLinks.forEach(link => {
        link.addEventListener('click', (e) => {
            e.preventDefault();
            const target = document.querySelector(e.target.getAttribute('href'));
            target.scrollIntoView({ behavior: 'smooth' });
        });
    });
});
