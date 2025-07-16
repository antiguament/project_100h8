<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Log;

class TestDatabaseConnection extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:test-connection';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test database connection and permissions';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Testing database connection and permissions...');
        
        // Test connection
        try {
            DB::connection()->getPdo();
            $this->info('✅ Database connection successful');
            
            // Check if we can query the database
            $tables = DB::select('SHOW TABLES');
            $this->info('✅ Database query successful. Tables count: ' . count($tables));
            
            // Check if pages table exists
            if (Schema::hasTable('pages')) {
                $this->info('✅ Pages table exists');
                
                // Try to insert a test record
                try {
                    $id = DB::table('pages')->insertGetId([
                        'title' => 'Test Page',
                        'slug' => 'test-page-' . time(),
                        'hero_title' => 'Test',
                        'hero_subtitle' => 'Test Subtitle',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                    
                    $this->info("✅ Successfully inserted test page with ID: $id");
                    
                    // Try to update the record
                    $updated = DB::table('pages')
                        ->where('id', $id)
                        ->update(['title' => 'Updated Test Page']);
                        
                    if ($updated) {
                        $this->info('✅ Successfully updated test page');
                    } else {
                        $this->warn('⚠️ Could not update test page');
                    }
                    
                    // Clean up
                    DB::table('pages')->where('id', $id)->delete();
                    $this->info('✅ Cleaned up test data');
                    
                } catch (\Exception $e) {
                    $this->error('❌ Error performing database operations: ' . $e->getMessage());
                    Log::error('Database test error: ' . $e->getMessage(), [
                        'exception' => $e,
                        'trace' => $e->getTraceAsString()
                    ]);
                }
                
            } else {
                $this->warn('⚠️ Pages table does not exist');
            }
            
        } catch (\Exception $e) {
            $this->error('❌ Database connection failed: ' . $e->getMessage());
            Log::error('Database connection failed: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return 1;
        }
        
        // Test storage permissions
        $this->info('\nTesting storage permissions...');
        $testFile = storage_path('test_permission.txt');
        
        try {
            file_put_contents($testFile, 'test');
            $this->info('✅ Successfully wrote to storage');
            
            if (unlink($testFile)) {
                $this->info('✅ Successfully deleted test file from storage');
            } else {
                $this->warn('⚠️ Could not delete test file from storage');
            }
        } catch (\Exception $e) {
            $this->error('❌ Storage permission test failed: ' . $e->getMessage());
            return 1;
        }
        
        return 0;
    }
}
