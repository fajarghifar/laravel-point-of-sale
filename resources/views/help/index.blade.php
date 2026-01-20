@extends('dashboard.body.main')

@section('specificpagestyles')
    @vite(['resources/css/app.css'])
    <style>
        /* Protect sidebar from Tailwind CSS reset interference */
        /* Ensure sidebar menu items remain visible and functional */
        .iq-sidebar-menu .iq-menu li,
        .iq-sidebar-menu .iq-menu li a,
        .iq-sidebar-menu .iq-menu li ul,
        .iq-sidebar-menu .iq-menu li .iq-submenu,
        .iq-sidebar-menu .iq-menu li .iq-submenu li,
        .iq-sidebar-menu .iq-menu li .iq-submenu li a {
            visibility: visible !important;
        }
        
        /* Preserve collapse/expand behavior for submenus */
        .iq-submenu.collapse:not(.show) {
            display: none !important;
        }
        .iq-submenu.collapse.show {
            display: block !important;
        }
        
        /* Ensure links in submenu are visible and clickable */
        .iq-submenu li a,
        .iq-submenu li a span {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }
    </style>
@endsection

@section('container')
    <div class="container mx-auto px-4 py-6">
        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="flex flex-wrap items-center justify-between mb-8">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Help & Documentation</h2>
                    <p class="text-gray-600">Comprehensive guide to POSDash - Your Point of Sale Management System</p>
                </div>
            </div>

            <!-- Introduction Card -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8 border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-3">About POSDash</h3>
                <p class="text-gray-700 leading-relaxed">
                    POSDash is a robust, enterprise-grade Point of Sale (POS) management system designed for efficiency and ease of use.
                    This application provides comprehensive tools for managing sales, inventory, employees, customers, and financial operations
                    all in one integrated platform.
                </p>
            </div>

            <!-- Feature Categories -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <!-- Point of Sale (POS) -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-shopping-cart class="w-6 h-6 text-blue-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Point of Sale (POS)</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Fast and user-friendly transaction processing interface</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Smart product search by name or code</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Real-time cart management with dynamic calculations</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Automatic subtotal and tax calculations</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Customer selection and quick customer creation</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Professional invoice and receipt generation</span>
                        </li>
                    </ul>
                </div>

                <!-- Product & Inventory Management -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-cyan-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-archive-box class="w-6 h-6 text-cyan-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Product & Inventory</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Complete product catalog management</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Hierarchical category organization</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Automated stock tracking and deduction</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Barcode support for product identification</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Product import/export functionality</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Expiry date tracking for products</span>
                        </li>
                    </ul>
                </div>

                <!-- Order Management -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-shopping-bag class="w-6 h-6 text-green-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Order Management</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Track pending and completed orders</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Manage pending due payments</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Detailed order information and history</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Update order status (pending to complete)</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Download invoices and print receipts</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Automatic invoice number generation</span>
                        </li>
                    </ul>
                </div>

                <!-- Customer Management -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-yellow-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-user-group class="w-6 h-6 text-yellow-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Customer Management</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Comprehensive customer database</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Customer profiles with contact information</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Quick customer search and selection</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Customer order history tracking</span>
                        </li>
                    </ul>
                </div>

                <!-- Supplier Management -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-red-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-user-group class="w-6 h-6 text-red-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Supplier Management</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Maintain supplier information database</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Track supplier contact details</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Manage supplier relationships</span>
                        </li>
                    </ul>
                </div>

                <!-- Employee Management -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-user-group class="w-6 h-6 text-blue-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Employee Management</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Complete employee records and profiles</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Employee photo management</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Employee contact and salary information</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Employee data search and filtering</span>
                        </li>
                    </ul>
                </div>

                <!-- HR & Payroll -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-cyan-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-banknotes class="w-6 h-6 text-cyan-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">HR & Payroll</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Employee attendance tracking</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Advance salary management</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Monthly salary payment processing</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Bulk salary payment option</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Complete salary payment history</span>
                        </li>
                    </ul>
                </div>

                <!-- Financial Reporting -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-green-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-chart-bar class="w-6 h-6 text-green-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Financial Reporting</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Interactive dashboard with key metrics</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Monthly sales trends visualization</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Top-selling products analysis</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Total paid and due amounts tracking</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Recent transactions overview</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Professional invoice and receipt printing</span>
                        </li>
                    </ul>
                </div>

                <!-- User & Access Control -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-yellow-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-key class="w-6 h-6 text-yellow-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">User & Access Control</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>User account management</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Role-based access control (RBAC)</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Granular permission management</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Role and permission assignment</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Secure authentication system</span>
                        </li>
                    </ul>
                </div>

                <!-- Database Management -->
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="flex items-center mb-4">
                        <div class="bg-red-100 rounded-lg p-3 mr-4">
                            <x-heroicon-o-circle-stack class="w-6 h-6 text-red-600" />
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800">Database Management</h3>
                    </div>
                    <ul class="space-y-2">
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>On-demand database backup creation</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Backup file download</span>
                        </li>
                        <li class="flex items-start text-gray-700">
                            <x-heroicon-o-check-circle class="w-5 h-5 text-green-500 mr-2 mt-0.5 flex-shrink-0" />
                            <span>Backup file management and deletion</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Technical Information -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-8 border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Technical Stack</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-bold text-gray-700 mb-3">Backend:</h4>
                        <ul class="list-disc list-inside space-y-1 text-gray-700">
                            <li>Laravel 10 (PHP 8.1+)</li>
                            <li>MySQL / MariaDB Database</li>
                            <li>Spatie Laravel Permission (RBAC)</li>
                            <li>Shopping Cart Package</li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-700 mb-3">Frontend:</h4>
                        <ul class="list-disc list-inside space-y-1 text-gray-700">
                            <li>Blade Templates</li>
                            <li>Bootstrap 4/5 (Layout)</li>
                            <li>Tailwind CSS (Utilities)</li>
                            <li>Vanilla JavaScript</li>
                            <li>ApexCharts (Analytics)</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Quick Tips -->
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Quick Tips</h3>
                <ul class="space-y-3">
                    <li class="flex items-start text-gray-700">
                        <x-heroicon-o-light-bulb class="w-5 h-5 text-yellow-500 mr-3 mt-0.5 flex-shrink-0" />
                        <span>Use the search functionality to quickly find products, customers, or employees</span>
                    </li>
                    <li class="flex items-start text-gray-700">
                        <x-heroicon-o-light-bulb class="w-5 h-5 text-yellow-500 mr-3 mt-0.5 flex-shrink-0" />
                        <span>Stock is automatically deducted when orders are marked as complete</span>
                    </li>
                    <li class="flex items-start text-gray-700">
                        <x-heroicon-o-light-bulb class="w-5 h-5 text-yellow-500 mr-3 mt-0.5 flex-shrink-0" />
                        <span>You can track pending due payments and update them as customers pay</span>
                    </li>
                    <li class="flex items-start text-gray-700">
                        <x-heroicon-o-light-bulb class="w-5 h-5 text-yellow-500 mr-3 mt-0.5 flex-shrink-0" />
                        <span>The dashboard provides real-time insights into your sales performance</span>
                    </li>
                    <li class="flex items-start text-gray-700">
                        <x-heroicon-o-light-bulb class="w-5 h-5 text-yellow-500 mr-3 mt-0.5 flex-shrink-0" />
                        <span>Regular database backups are recommended to protect your data</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
