{{-- FILE: resources/views/sysadmin/dashboard/course_admin_management/_form.blade.php --}}
<div class="space-y-6">
    <div>
        <label for="name" class="block text-sm font-medium text-secondary mb-2">Nama Lengkap</label>
        <input type="text" name="name" id="name" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="Masukkan nama lengkap admin"
            value="{{ old('name', $courseAdmin->name ?? '') }}" required>
        @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="email" class="block text-sm font-medium text-secondary mb-2">Alamat Email</label>
        <input type="email" name="email" id="email" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="admin@email.com"
            value="{{ old('email', $courseAdmin->email ?? '') }}" required>
        @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="password" class="block text-sm font-medium text-secondary mb-2">Password @if(isset($edit)) <span class="text-xs font-normal text-secondary/70">(Kosongkan jika tidak ingin mengubah)</span> @endif</label>
        <input type="password" id="password" name="password" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="••••••••">
        @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
    </div>

    <div>
        <label for="password_confirmation" class="block text-sm font-medium text-secondary mb-2">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" 
            class="w-full bg-background border border-border rounded-lg px-4 py-2.5 text-primary placeholder-secondary/50 focus:ring-2 focus:ring-primary/20 focus:border-primary transition-colors duration-200" 
            placeholder="••••••••">
    </div>

    <div class="flex items-center gap-3 pt-4 border-t border-border">
        <button type="submit" class="px-6 py-2.5 bg-primary text-background font-medium rounded-lg hover:bg-primary/90 transition-colors focus:ring-2 focus:ring-primary focus:ring-offset-2">
            Simpan Data
        </button>
        <a href="{{ route('sysadmin.manage_course_admin.index') }}" class="px-6 py-2.5 bg-surface border border-border text-secondary font-medium rounded-lg hover:text-primary hover:border-primary transition-colors focus:ring-2 focus:ring-border">
            Batal
        </a>
    </div>
</div>