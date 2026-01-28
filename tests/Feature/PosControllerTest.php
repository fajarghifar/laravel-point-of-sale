<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PosControllerTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create permission if it doesn't exist (outside transaction)
        // Using firstOrCreate ensures it only creates if it doesn't exist
        Permission::firstOrCreate(
            ['name' => 'pos.menu'],
            ['group_name' => 'pos']
        );
        
        // Create a role and assign permission (outside transaction)
        $role = Role::firstOrCreate(['name' => 'test-role']);
        if (!$role->hasPermissionTo('pos.menu')) {
            $role->givePermissionTo('pos.menu');
        }
    }

    protected function createAuthenticatedUser(): User
    {
        $user = User::factory()->create();
        $role = Role::where('name', 'test-role')->first();
        $user->assignRole($role);
        return $user;
    }

    protected function createCategory(): Category
    {
        return Category::factory()->create();
    }

    protected function createProductWithCode(string $name, string $code, ?Category $category = null): Product
    {
        if (!$category) {
            $category = $this->createCategory();
        }

        return Product::factory()->create([
            'name' => $name,
            'code' => $code,
            'category_id' => $category->id,
            'expire_date' => Carbon::now()->addYear(), // Ensure product is not expired
        ]);
    }

    public function test_pos_page_requires_authentication(): void
    {
        $response = $this->get('/pos');

        // POS requires authentication and permission
        // Unauthenticated users get 403 (Forbidden) or redirect to login
        $this->assertTrue(
            $response->status() === 403 || 
            $response->status() === 302 ||
            $response->isRedirect('/login')
        );
    }

    public function test_pos_page_is_displayed_for_authenticated_users(): void
    {
        $user = $this->createAuthenticatedUser();

        $response = $this->actingAs($user)->get('/pos');

        $response->assertOk();
        $response->assertViewIs('pos.index');
    }

    public function test_pos_search_by_product_name(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create products with different names
        $product1 = $this->createProductWithCode('Laptop Computer', 'LAPTOP-001', $category);
        $product2 = $this->createProductWithCode('Desktop Computer', 'DESKTOP-001', $category);
        $product3 = $this->createProductWithCode('Mouse Pad', 'MOUSE-001', $category);

        // Search by name
        $response = $this->actingAs($user)->get('/pos?search=Laptop');

        $response->assertOk();
        $response->assertSee('Laptop Computer', false);
        $response->assertDontSee('Desktop Computer', false);
        $response->assertDontSee('Mouse Pad', false);
    }

    public function test_pos_search_by_product_code(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create products with different codes
        $product1 = $this->createProductWithCode('Product One', 'BC-12345', $category);
        $product2 = $this->createProductWithCode('Product Two', 'BC-67890', $category);
        $product3 = $this->createProductWithCode('Product Three', 'BC-11111', $category);

        // Search by code
        $response = $this->actingAs($user)->get('/pos?search=BC-12345');

        $response->assertOk();
        $response->assertSee('Product One', false);
        $response->assertDontSee('Product Two', false);
        $response->assertDontSee('Product Three', false);
    }

    public function test_pos_search_finds_product_by_partial_code(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create product with specific code
        $product = $this->createProductWithCode('Scannable Product', 'BC-12345-XYZ', $category);

        // Search by partial code
        $response = $this->actingAs($user)->get('/pos?search=BC-12345');

        $response->assertOk();
        // Should find the product by its code
        $response->assertSee('Scannable Product', false);
    }

    public function test_pos_search_finds_product_by_partial_name(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create products
        $product1 = $this->createProductWithCode('Apple iPhone', 'IPHONE-001', $category);
        $product2 = $this->createProductWithCode('Samsung Galaxy', 'GALAXY-001', $category);
        $product3 = $this->createProductWithCode('Google Pixel', 'PIXEL-001', $category);

        // Search by partial name
        $response = $this->actingAs($user)->get('/pos?search=Apple');

        $response->assertOk();
        $response->assertSee('Apple iPhone', false);
        $response->assertDontSee('Samsung Galaxy', false);
        $response->assertDontSee('Google Pixel', false);
    }

    public function test_pos_search_returns_multiple_results_when_matching(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create products with similar names
        $product1 = $this->createProductWithCode('MacBook Pro', 'MBP-001', $category);
        $product2 = $this->createProductWithCode('MacBook Air', 'MBA-001', $category);
        $product3 = $this->createProductWithCode('Windows Laptop', 'WIN-001', $category);

        // Search should find both MacBooks
        $response = $this->actingAs($user)->get('/pos?search=MacBook');

        $response->assertOk();
        $response->assertSee('MacBook Pro', false);
        $response->assertSee('MacBook Air', false);
        $response->assertDontSee('Windows Laptop', false);
    }

    public function test_pos_search_returns_empty_when_no_match(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create products
        $this->createProductWithCode('Product A', 'CODE-001', $category);
        $this->createProductWithCode('Product B', 'CODE-002', $category);

        // Search for something that doesn't exist
        $response = $this->actingAs($user)->get('/pos?search=NonexistentProduct');

        $response->assertOk();
        $response->assertDontSee('Product A', false);
        $response->assertDontSee('Product B', false);
    }

    public function test_pos_search_is_case_insensitive(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create product with mixed case
        $product = $this->createProductWithCode('Test Product', 'TEST-CODE', $category);

        // Search with different cases
        $response1 = $this->actingAs($user)->get('/pos?search=test');
        $response2 = $this->actingAs($user)->get('/pos?search=TEST');
        $response3 = $this->actingAs($user)->get('/pos?search=Test');

        $response1->assertOk();
        $response1->assertSee('Test Product', false);

        $response2->assertOk();
        $response2->assertSee('Test Product', false);

        $response3->assertOk();
        $response3->assertSee('Test Product', false);
    }

    public function test_pos_search_works_with_barcode_scanner_format(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create product with barcode-like code
        $product = $this->createProductWithCode('Scanned Product', '1234567890123', $category);

        // Search using the full barcode
        $response = $this->actingAs($user)->get('/pos?search=1234567890123');

        $response->assertOk();
        $response->assertSee('Scanned Product', false);
    }

    public function test_pos_search_excludes_expired_products(): void
    {
        $user = $this->createAuthenticatedUser();
        $category = $this->createCategory();

        // Create expired product
        $expiredProduct = Product::factory()->create([
            'name' => 'Expired Product',
            'code' => 'EXPIRED-001',
            'category_id' => $category->id,
            'expire_date' => Carbon::now()->subDay(), // Expired yesterday
        ]);

        // Create valid product
        $validProduct = $this->createProductWithCode('Valid Product', 'VALID-001', $category);

        // Search should only return valid product
        $response = $this->actingAs($user)->get('/pos?search=Product');

        $response->assertOk();
        $response->assertSee('Valid Product', false);
        $response->assertDontSee('Expired Product', false);
    }

    public function test_pos_search_combines_with_category_filter(): void
    {
        $user = $this->createAuthenticatedUser();
        $category1 = $this->createCategory();
        $category2 = Category::factory()->create();

        // Create products in different categories with similar names
        $product1 = $this->createProductWithCode('Laptop A', 'LAP-001', $category1);
        $product2 = $this->createProductWithCode('Laptop B', 'LAP-002', $category2);

        // Search with category filter - should only find product in category1
        $response = $this->actingAs($user)->get("/pos?search=Laptop&category_id={$category1->id}");

        $response->assertOk();
        // Should find Laptop A which is in category1
        $response->assertSee('Laptop A', false);
    }

    public function test_pos_search_field_has_correct_placeholder(): void
    {
        $user = $this->createAuthenticatedUser();

        $response = $this->actingAs($user)->get('/pos');

        $response->assertOk();
        $response->assertSee('Search by name or barcode...', false);
    }
}
