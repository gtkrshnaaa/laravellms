.PHONY: help list list-controllers list-middleware list-models list-routes list-migrations list-views list-providers list-bootstrap list-factories list-seeders \
export-all export-controllers export-middleware export-models export-routes export-migrations export-views export-providers export-bootstrap export-factories export-seeders \
export-separate-all export-core

# Default target: tampilkan bantuan
help:
	@echo "Cara pakai:"
	@echo "  make help                 - Tampilkan bantuan ini"
	@echo "  make list                 - Tampilkan semua komponen (controllers, middleware, models, routes, migrations, views) beserta isinya ke terminal"
	@echo "  make export-all           - Export semua listing ke file laravel_components.txt di direktori 'z_laravel_export_list/'"
	@echo "  make export-separate-all  - Export semua komponen ke file terpisah di direktori 'z_laravel_export_list/'"
	@echo ""
	@echo "  make list-controllers     - Tampilkan file HTTP Controllers beserta isinya ke terminal"
	@echo "  make list-middleware      - Tampilkan file Middleware beserta isinya ke terminal"
	@echo "  make list-models          - Tampilkan file Models beserta isinya ke terminal"
	@echo "  make list-routes          - Tampilkan file Routes beserta isinya ke terminal"
	@echo "  make list-migrations      - Tampilkan file Database Migrations beserta isinya ke terminal"
	@echo "  make list-views           - Tampilkan file Blade Views beserta isinya ke terminal"
	@echo "  make list-providers       - Tampilkan file Service Providers beserta isinya ke terminal"
	@echo "  make list-bootstrap       - Tampilkan file Bootstrap beserta isinya ke terminal"
	@echo "  make list-factories       - Tampilkan file Model Factories beserta isinya ke terminal"
	@echo "  make list-seeders         - Tampilkan file Database Seeders beserta isinya ke terminal"
	@echo ""
	@echo "  make export-controllers   - Export HTTP Controllers ke z_laravel_export_list/controllers.txt"
	@echo "  make export-middleware    - Export Middleware ke z_laravel_export_list/middleware.txt"
	@echo "  make export-models        - Export Models ke z_laravel_export_list/models.txt"
	@echo "  make export-routes        - Export Routes ke z_laravel_export_list/routes.txt"
	@echo "  make export-migrations    - Export Migrations ke z_laravel_export_list/migrations.txt"
	@echo "  make export-views         - Export Blade Views ke z_laravel_export_list/views.txt"
	@echo "  make export-providers     - Export Service Providers ke z_laravel_export_list/providers.txt"
	@echo "  make export-bootstrap     - Export Bootstrap Files ke z_laravel_export_list/bootstrap.txt"
	@echo "  make export-factories     - Export Model Factories ke z_laravel_export_list/factories.txt"
	@echo "  make export-seeders       - Export Database Seeders ke z_laravel_export_list/seeders.txt"
	@echo ""
	@echo "Catatan: Pastikan Master menjalankan make di root direktori project Laravel Anda."

# Target utama: listing semua komponen ke terminal
list: list-controllers list-middleware list-models list-routes list-migrations list-views list-providers list-bootstrap list-factories list-seeders
	@echo ""
	@echo "=== Semua komponen Laravel sudah terdaftar beserta isinya ==="

# Target baru: export semua listing ke satu file besar
export-all:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor semua komponen Laravel beserta isinya ke z_laravel_export_list/laravel_components.txt..."
	@$(MAKE) list > z_laravel_export_list/laravel_components.txt
	@echo "Selesai! File 'z_laravel_export_list/laravel_components.txt' sudah dibuat di root direktori project Anda."

# Target baru: export Controllers, Models, Routes, dan Migrations ke satu file
export-core:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Controllers, Models, Routes, dan Migrations ke z_laravel_export_list/laravel_core.txt..."
	@echo "=== Laravel Core Components ===" > z_laravel_export_list/laravel_core.txt
	@$(MAKE) list-controllers >> z_laravel_export_list/laravel_core.txt
	@$(MAKE) list-models >> z_laravel_export_list/laravel_core.txt
	@$(MAKE) list-routes >> z_laravel_export_list/laravel_core.txt
	@$(MAKE) list-migrations >> z_laravel_export_list/laravel_core.txt
	@echo "Selesai! File 'z_laravel_export_list/laravel_core.txt' sudah dibuat."

# --- Export Semua Komponen ke File Terpisah ---
export-separate-all: export-controllers export-middleware export-models export-routes export-migrations export-views export-providers export-bootstrap export-factories export-seeders
	@echo ""
	@echo "=== Semua komponen Laravel sudah diekspor ke file terpisah di 'z_laravel_export_list/' ==="

# Listing HTTP Controllers
list-controllers:
	@echo "=== HTTP Controllers ==="
	@find app/Http/Controllers -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export HTTP Controllers
export-controllers:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor HTTP Controllers ke z_laravel_export_list/controllers.txt..."
	@echo "=== HTTP Controllers ===" > z_laravel_export_list/controllers.txt
	@find app/Http/Controllers -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/controllers.txt
	@echo "" >> z_laravel_export_list/controllers.txt
	@echo "Selesai! File 'z_laravel_export_list/controllers.txt' sudah dibuat."

# Listing Middleware
list-middleware:
	@echo "=== Middleware ==="
	@find app/Http/Middleware -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export Middleware
export-middleware:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Middleware ke z_laravel_export_list/middleware.txt..."
	@echo "=== Middleware ===" > z_laravel_export_list/middleware.txt
	@find app/Http/Middleware -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/middleware.txt
	@echo "" >> z_laravel_export_list/middleware.txt
	@echo "Selesai! File 'z_laravel_export_list/middleware.txt' sudah dibuat."

# Listing Models
list-models:
	@echo "=== Models ==="
	@find app/Models -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export Models
export-models:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Models ke z_laravel_export_list/models.txt..."
	@echo "=== Models ===" > z_laravel_export_list/models.txt
	@find app/Models -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/models.txt
	@echo "" >> z_laravel_export_list/models.txt
	@echo "Selesai! File 'z_laravel_export_list/models.txt' sudah dibuat."

# Listing Routes
list-routes:
	@echo "=== Routes ==="
	@find routes -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export Routes
export-routes:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Routes ke z_laravel_export_list/routes.txt..."
	@echo "=== Routes ===" > z_laravel_export_list/routes.txt
	@find routes -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/routes.txt
	@echo "" >> z_laravel_export_list/routes.txt
	@echo "Selesai! File 'z_laravel_export_list/routes.txt' sudah dibuat."

# Listing Database Migrations
list-migrations:
	@echo "=== Database Migrations ==="
	@find database/migrations -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export Database Migrations
export-migrations:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Database Migrations ke z_laravel_export_list/migrations.txt..."
	@echo "=== Database Migrations ===" > z_laravel_export_list/migrations.txt
	@find database/migrations -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/migrations.txt
	@echo "" >> z_laravel_export_list/migrations.txt
	@echo "Selesai! File 'z_laravel_export_list/migrations.txt' sudah dibuat."

# Listing Model Factories
list-factories:
	@echo "=== Model Factories ==="
	@find database/factories -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export Model Factories
export-factories:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Model Factories ke z_laravel_export_list/factories.txt..."
	@echo "=== Model Factories ===" > z_laravel_export_list/factories.txt
	@find database/factories -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/factories.txt
	@echo "" >> z_laravel_export_list/factories.txt
	@echo "Selesai! File 'z_laravel_export_list/factories.txt' sudah dibuat."

# Listing Database Seeders
list-seeders:
	@echo "=== Database Seeders ==="
	@find database/seeders -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export Database Seeders
export-seeders:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Database Seeders ke z_laravel_export_list/seeders.txt..."
	@echo "=== Database Seeders ===" > z_laravel_export_list/seeders.txt
	@find database/seeders -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/seeders.txt
	@echo "" >> z_laravel_export_list/seeders.txt
	@echo "Selesai! File 'z_laravel_export_list/seeders.txt' sudah dibuat."

# Listing Blade Views
list-views:
	@echo "=== Blade Views ==="
	@find resources/views -name "*.blade.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export Blade Views
export-views:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Blade Views ke z_laravel_export_list/views.txt..."
	@echo "=== Blade Views ===" > z_laravel_export_list/views.txt
	@find resources/views -name "*.blade.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/views.txt
	@echo "" >> z_laravel_export_list/views.txt
	@echo "Selesai! File 'z_laravel_export_list/views.txt' sudah dibuat."

# Listing Service Providers
list-providers:
	@echo "=== Service Providers ==="
	@find app/Providers -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \;
	@echo ""

# Export Service Providers
export-providers:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Service Providers ke z_laravel_export_list/providers.txt..."
	@echo "=== Service Providers ===" > z_laravel_export_list/providers.txt
	@find app/Providers -name "*.php" -print -exec sh -c 'echo "\n--- FILE: {} ---"; cat "{}"; echo "--- END FILE: {} ---\n"' \; >> z_laravel_export_list/providers.txt
	@echo "" >> z_laravel_export_list/providers.txt
	@echo "Selesai! File 'z_laravel_export_list/providers.txt' sudah dibuat."

# Listing Bootstrap Files
list-bootstrap:
	@echo "=== Bootstrap Files ==="
	@# Cek dan tampilkan bootstrap/app.php jika ada
	@if [ -f bootstrap/app.php ]; then \
		echo "\n--- FILE: bootstrap/app.php ---"; \
		cat bootstrap/app.php; \
		echo "--- END FILE: bootstrap/app.php ---\n"; \
	fi
	@# Cek dan tampilkan bootstrap/providers.php jika ada (ada di Laravel 11+)
	@if [ -f bootstrap/providers.php ]; then \
		echo "\n--- FILE: bootstrap/providers.php ---"; \
		cat bootstrap/providers.php; \
		echo "--- END FILE: bootstrap/providers.php ---\n"; \
	fi
	@echo ""

# Export Bootstrap Files
export-bootstrap:
	@mkdir -p z_laravel_export_list
	@echo "Mengekspor Bootstrap Files ke z_laravel_export_list/bootstrap.txt..."
	@echo "=== Bootstrap Files ===" > z_laravel_export_list/bootstrap.txt
	@if [ -f bootstrap/app.php ]; then \
		echo "\n--- FILE: bootstrap/app.php ---" >> z_laravel_export_list/bootstrap.txt; \
		cat bootstrap/app.php >> z_laravel_export_list/bootstrap.txt; \
		echo "--- END FILE: bootstrap/app.php ---\n" >> z_laravel_export_list/bootstrap.txt; \
	fi
	@if [ -f bootstrap/providers.php ]; then \
		echo "\n--- FILE: bootstrap/providers.php ---" >> z_laravel_export_list/bootstrap.txt; \
		cat bootstrap/providers.php >> z_laravel_export_list/bootstrap.txt; \
		echo "--- END FILE: bootstrap/providers.php ---\n" >> z_laravel_export_list/bootstrap.txt; \
	fi
	@echo "" >> z_laravel_export_list/bootstrap.txt
	@echo "Selesai! File 'z_laravel_export_list/bootstrap.txt' sudah dibuat."