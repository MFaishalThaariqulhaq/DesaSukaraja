<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Profil Desa</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        /* Custom Scrollbar for smooth look */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9; 
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1; 
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8; 
        }
        .tab-btn.active-tab {
            color: #059669; /* emerald-600 */
            border-bottom-color: #34d399; /* emerald-400 */
            background-color: #ecfdf5; /* emerald-50 */
        }
    </style>
</head>
<body class="bg-slate-50 font-sans text-slate-800">

    <div class="flex h-screen overflow-hidden">
        
        <!-- SIDEBAR (Simulasi) -->
        <aside class="w-64 bg-slate-900 text-white hidden md:flex flex-col">
            <div class="p-6 flex items-center gap-3 font-bold text-xl border-b border-slate-700">
                <div class="w-8 h-8 bg-emerald-500 rounded flex items-center justify-center">DS</div>
                Desa Sukaraja
            </div>
            <nav class="flex-1 overflow-y-auto p-4 space-y-2">
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                    <i data-lucide="layout-dashboard" class="w-5 h-5"></i> Dashboard
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                    <i data-lucide="newspaper" class="w-5 h-5"></i> Berita Desa
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 bg-emerald-600 text-white rounded-lg shadow-lg shadow-emerald-900/20 transition">
                    <i data-lucide="building-2" class="w-5 h-5"></i> Profil Desa
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                    <i data-lucide="users" class="w-5 h-5"></i> Penduduk
                </a>
                <a href="#" class="flex items-center gap-3 px-4 py-3 text-slate-400 hover:bg-slate-800 hover:text-white rounded-lg transition">
                    <i data-lucide="message-square" class="w-5 h-5"></i> Pengaduan
                </a>
            </nav>
            <div class="p-4 border-t border-slate-700">
                <div class="flex items-center gap-3">
                    <img src="https://ui-avatars.com/api/?name=Admin+Desa&background=random" class="w-10 h-10 rounded-full">
                    <div>
                        <p class="text-sm font-bold">Administrator</p>
                        <p class="text-xs text-slate-400">admin@sukaraja.desa.id</p>
                    </div>
                </div>
            </div>
        </aside>

        <!-- MAIN CONTENT -->
        <main class="flex-1 overflow-y-auto relative">
            <!-- Header Mobile -->
            <div class="md:hidden bg-slate-900 text-white p-4 flex justify-between items-center">
                <span class="font-bold">Desa Sukaraja</span>
                <i data-lucide="menu" class="w-6 h-6"></i>
            </div>

            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">
                
                <!-- Page Title -->
                <div class="mb-8 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">Manajemen Profil Desa</h1>
                        <p class="text-slate-500 text-sm mt-1">Kelola identitas, visi misi, sejarah, dan struktur organisasi.</p>
                    </div>
                    <div>
                        <button class="bg-white border border-slate-300 text-slate-600 px-4 py-2 rounded-lg text-sm font-semibold hover:bg-slate-50 transition flex items-center gap-2">
                            <i data-lucide="external-link" class="w-4 h-4"></i> Lihat Website
                        </button>
                    </div>
                </div>

                <!-- NOTIFICATION MOCKUP (Bisa di close) -->
                <div id="notification" class="hidden bg-emerald-100 border border-emerald-400 text-emerald-700 px-4 py-3 rounded relative mb-6 animate-pulse">
                    <strong class="font-bold">Berhasil!</strong>
                    <span class="block sm:inline">Data profil desa berhasil diperbarui.</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" onclick="this.parentElement.style.display='none';">
                        <i data-lucide="x" class="w-4 h-4"></i>
                    </span>
                </div>

                <!-- CONTENT CARD -->
                <div class="bg-white rounded-xl shadow-lg border border-slate-200 overflow-hidden min-h-[600px]">
                    
                    <!-- TAB NAVIGATION -->
                    <div class="flex border-b border-slate-200 overflow-x-auto bg-slate-50/50">
                        <button onclick="switchTab('umum')" id="btn-umum" class="tab-btn active-tab px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
                            <i data-lucide="home" class="w-4 h-4"></i> Identitas Umum
                        </button>
                        <button onclick="switchTab('visimisi')" id="btn-visimisi" class="tab-btn px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
                            <i data-lucide="target" class="w-4 h-4"></i> Visi & Misi
                        </button>
                        <button onclick="switchTab('sejarah')" id="btn-sejarah" class="tab-btn px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
                            <i data-lucide="history" class="w-4 h-4"></i> Sejarah (Timeline)
                        </button>
                        <button onclick="switchTab('struktur')" id="btn-struktur" class="tab-btn px-6 py-4 text-sm font-bold text-slate-600 hover:text-emerald-600 border-b-2 border-transparent transition-all whitespace-nowrap flex items-center gap-2">
                            <i data-lucide="users" class="w-4 h-4"></i> Struktur Organisasi
                        </button>
                    </div>

                    <!-- TAB CONTENTS -->
                    <div class="p-6 md:p-8">

                        <!-- 1. TAB IDENTITAS UMUM -->
                        <div id="tab-umum" class="tab-content block animate-fade-in">
                            <form onsubmit="event.preventDefault(); showSuccess();">
                                <div class="grid md:grid-cols-12 gap-8">
                                    <!-- Foto Kades -->
                                    <div class="md:col-span-4 lg:col-span-3">
                                        <label class="block text-slate-700 font-bold mb-2">Foto Kepala Desa</label>
                                        <div class="group relative rounded-xl overflow-hidden border-2 border-dashed border-slate-300 bg-slate-50 hover:bg-slate-100 transition aspect-[3/4]">
                                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=80" class="w-full h-full object-cover">
                                            <div class="absolute inset-0 bg-black/40 flex flex-col items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                                                <i data-lucide="upload-cloud" class="w-8 h-8 text-white mb-2"></i>
                                                <span class="text-white text-sm font-semibold">Ganti Foto</span>
                                            </div>
                                            <input type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                                        </div>
                                        <p class="text-xs text-slate-500 mt-2 text-center">Format: JPG, PNG. Max: 2MB</p>
                                    </div>

                                    <!-- Form Fields -->
                                    <div class="md:col-span-8 lg:col-span-9 space-y-5">
                                        <div class="grid md:grid-cols-2 gap-5">
                                            <div>
                                                <label class="block text-slate-700 font-bold mb-2 text-sm">Nama Kepala Desa</label>
                                                <input type="text" value="H. Asep Saifudin" class="w-full border-slate-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-emerald-500 outline-none transition bg-white" placeholder="Nama Lengkap">
                                            </div>
                                            <div>
                                                <label class="block text-slate-700 font-bold mb-2 text-sm">Periode Jabatan</label>
                                                <input type="text" value="2020 - 2026" class="w-full border-slate-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-emerald-500 outline-none transition bg-white" placeholder="Contoh: 2020 - 2026">
                                            </div>
                                        </div>
                                        
                                        <div>
                                            <label class="block text-slate-700 font-bold mb-2 text-sm">Judul Sambutan</label>
                                            <input type="text" value="Mewujudkan Pelayanan Publik yang Prima dan Transparan" class="w-full border-slate-300 rounded-lg p-2.5 border focus:ring-2 focus:ring-emerald-500 outline-none transition bg-white">
                                        </div>
                                        
                                        <div>
                                            <label class="block text-slate-700 font-bold mb-2 text-sm">Isi Sambutan</label>
                                            <textarea rows="6" class="w-full border-slate-300 rounded-lg p-3 border focus:ring-2 focus:ring-emerald-500 outline-none transition bg-white leading-relaxed text-slate-600">Assalamualaikum Warahmatullahi Wabarakatuh. Puji syukur kita panjatkan ke hadirat Allah SWT. Selamat datang di portal digital resmi Desa Sukaraja.

Di era digital ini, transparansi dan kecepatan informasi menjadi kunci utama dalam pelayanan publik. Website ini kami hadirkan sebagai wujud komitmen kami untuk mendekatkan pemerintah desa dengan masyarakat.</textarea>
                                            <p class="text-xs text-slate-400 mt-1 text-right">0 / 1000 Karakter</p>
                                        </div>

                                        <div class="pt-4 border-t border-slate-100 flex justify-end">
                                            <button type="submit" class="bg-emerald-600 text-white px-8 py-2.5 rounded-lg hover:bg-emerald-700 shadow-lg shadow-emerald-200 transition font-semibold flex items-center gap-2">
                                                <i data-lucide="save" class="w-4 h-4"></i> Simpan Perubahan
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- 2. TAB VISI & MISI -->
                        <div id="tab-visimisi" class="tab-content hidden animate-fade-in">
                            <div class="grid md:grid-cols-2 gap-8 h-full">
                                <!-- Kiri: Visi -->
                                <div class="bg-slate-50 p-6 rounded-xl border border-slate-200 h-full">
                                    <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                        <i data-lucide="eye" class="w-5 h-5 text-emerald-600"></i> Visi Desa
                                    </h3>
                                    <form onsubmit="event.preventDefault(); showSuccess();">
                                        <textarea rows="8" class="w-full border-slate-300 rounded-lg p-4 border focus:ring-2 focus:ring-emerald-500 outline-none transition bg-white mb-4 text-lg italic text-slate-700 leading-relaxed shadow-inner" placeholder="Tuliskan Visi Desa...">&quot;Terwujudnya Desa Sukaraja yang Maju, Mandiri, Berdaya Saing, dan Berakhlak Mulia Berlandaskan Gotong Royong.&quot;</textarea>
                                        <button type="submit" class="w-full bg-slate-800 text-white py-2.5 rounded-lg hover:bg-slate-700 transition font-medium">Update Visi</button>
                                    </form>
                                </div>

                                <!-- Kanan: Misi -->
                                <div class="flex flex-col h-full">
                                    <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                                        <i data-lucide="list-checks" class="w-5 h-5 text-emerald-600"></i> Daftar Misi
                                    </h3>
                                    
                                    <!-- List Misi -->
                                    <div class="flex-1 overflow-y-auto max-h-[400px] space-y-3 mb-6 pr-2">
                                        <!-- Item 1 -->
                                        <div class="flex items-start justify-between bg-white border border-slate-200 p-4 rounded-lg shadow-sm hover:border-emerald-300 transition group">
                                            <div class="flex gap-4">
                                                <span class="bg-emerald-100 text-emerald-700 w-8 h-8 flex-shrink-0 flex items-center justify-center rounded-full text-sm font-bold">1</span>
                                                <p class="text-slate-700 text-sm leading-relaxed pt-1">Mewujudkan tata kelola pemerintahan desa yang jujur, transparan, dan akuntabel.</p>
                                            </div>
                                            <button class="text-slate-400 hover:text-red-500 p-1 opacity-0 group-hover:opacity-100 transition"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                        <!-- Item 2 -->
                                        <div class="flex items-start justify-between bg-white border border-slate-200 p-4 rounded-lg shadow-sm hover:border-emerald-300 transition group">
                                            <div class="flex gap-4">
                                                <span class="bg-emerald-100 text-emerald-700 w-8 h-8 flex-shrink-0 flex items-center justify-center rounded-full text-sm font-bold">2</span>
                                                <p class="text-slate-700 text-sm leading-relaxed pt-1">Meningkatkan kualitas sumber daya manusia melalui pendidikan dan kesehatan.</p>
                                            </div>
                                            <button class="text-slate-400 hover:text-red-500 p-1 opacity-0 group-hover:opacity-100 transition"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                        <!-- Item 3 -->
                                        <div class="flex items-start justify-between bg-white border border-slate-200 p-4 rounded-lg shadow-sm hover:border-emerald-300 transition group">
                                            <div class="flex gap-4">
                                                <span class="bg-emerald-100 text-emerald-700 w-8 h-8 flex-shrink-0 flex items-center justify-center rounded-full text-sm font-bold">3</span>
                                                <p class="text-slate-700 text-sm leading-relaxed pt-1">Mengoptimalkan potensi ekonomi lokal dan pemberdayaan UMKM desa.</p>
                                            </div>
                                            <button class="text-slate-400 hover:text-red-500 p-1 opacity-0 group-hover:opacity-100 transition"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                        </div>
                                    </div>

                                    <!-- Form Add Misi -->
                                    <form onsubmit="event.preventDefault(); alert('Misi ditambahkan!');" class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-2">Tambah Misi Baru</label>
                                        <div class="flex gap-2">
                                            <input type="number" value="4" class="w-16 border border-slate-300 rounded-lg px-3 py-2 text-center font-bold" title="Urutan">
                                            <input type="text" class="flex-1 border border-slate-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-emerald-500 outline-none" placeholder="Isi misi baru..." required>
                                            <button type="submit" class="bg-emerald-500 text-white px-4 rounded-lg hover:bg-emerald-600 transition shadow">
                                                <i data-lucide="plus" class="w-5 h-5"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- 3. TAB SEJARAH -->
                        <div id="tab-sejarah" class="tab-content hidden animate-fade-in">
                            <div class="flex justify-between items-center mb-6">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-800">Timeline Sejarah Desa</h3>
                                    <p class="text-slate-500 text-sm">Urutan peristiwa penting perjalanan desa.</p>
                                </div>
                                <button onclick="toggleHistoryForm()" class="bg-emerald-600 text-white px-5 py-2.5 rounded-lg text-sm font-bold hover:bg-emerald-700 transition flex items-center gap-2 shadow-lg shadow-emerald-200">
                                    <i data-lucide="plus-circle" class="w-4 h-4"></i> Tambah Peristiwa
                                </button>
                            </div>

                            <!-- Form Tambah Sejarah (Toggle) -->
                            <div id="history-form" class="hidden bg-slate-50 p-6 rounded-xl mb-8 border border-slate-200 shadow-inner">
                                <h4 class="font-bold text-slate-700 mb-4 border-b pb-2">Form Peristiwa Baru</h4>
                                <form onsubmit="event.preventDefault(); showSuccess(); toggleHistoryForm();" class="grid md:grid-cols-12 gap-4">
                                    <div class="md:col-span-2">
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Tahun</label>
                                        <input type="text" class="w-full border border-slate-300 p-2.5 rounded-lg focus:ring-2 focus:ring-emerald-500 bg-white" placeholder="1999" required>
                                    </div>
                                    <div class="md:col-span-10">
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Judul Peristiwa</label>
                                        <input type="text" class="w-full border border-slate-300 p-2.5 rounded-lg focus:ring-2 focus:ring-emerald-500 bg-white" placeholder="Cth: Pemekaran Desa..." required>
                                    </div>
                                    <div class="md:col-span-12">
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Deskripsi</label>
                                        <textarea class="w-full border border-slate-300 p-2.5 rounded-lg focus:ring-2 focus:ring-emerald-500 bg-white" rows="2" placeholder="Jelaskan secara singkat..."></textarea>
                                    </div>
                                    <div class="md:col-span-9">
                                        <label class="block text-xs font-bold text-slate-500 uppercase mb-1">Gambar (Opsional)</label>
                                        <input type="file" class="w-full bg-white p-2 border border-slate-300 rounded-lg text-sm text-slate-500 file:mr-4 file:py-1 file:px-4 file:rounded-full file:border-0 file:text-xs file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                                    </div>
                                    <div class="md:col-span-3 flex items-end">
                                        <button type="submit" class="w-full bg-slate-800 text-white py-2.5 rounded-lg hover:bg-slate-700 font-medium">Simpan Data</button>
                                    </div>
                                </form>
                            </div>

                            <!-- List Grid Sejarah -->
                            <div class="grid md:grid-cols-2 gap-5">
                                <!-- Card 1 -->
                                <div class="flex bg-white p-4 rounded-xl border border-slate-200 shadow-sm relative group hover:shadow-md transition">
                                    <img src="https://images.unsplash.com/photo-1500382017468-9049fed747ef" class="w-24 h-24 object-cover rounded-lg flex-shrink-0 mr-4 bg-slate-200">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2.5 py-1 rounded-md">1985</span>
                                            <div class="flex gap-2">
                                                <button class="text-slate-400 hover:text-emerald-600"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                                                <button class="text-slate-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                            </div>
                                        </div>
                                        <h4 class="font-bold text-slate-800 mt-2">Awal Pembentukan</h4>
                                        <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">Desa Sukaraja resmi dimekarkan dari desa induk dengan tujuan mempercepat pemerataan pembangunan.</p>
                                    </div>
                                </div>

                                <!-- Card 2 -->
                                <div class="flex bg-white p-4 rounded-xl border border-slate-200 shadow-sm relative group hover:shadow-md transition">
                                    <img src="https://images.unsplash.com/photo-1533038590840-1cde6e668a91" class="w-24 h-24 object-cover rounded-lg flex-shrink-0 mr-4 bg-slate-200">
                                    <div class="flex-1">
                                        <div class="flex justify-between items-start">
                                            <span class="bg-emerald-100 text-emerald-800 text-xs font-bold px-2.5 py-1 rounded-md">2005</span>
                                            <div class="flex gap-2">
                                                <button class="text-slate-400 hover:text-emerald-600"><i data-lucide="edit-3" class="w-4 h-4"></i></button>
                                                <button class="text-slate-400 hover:text-red-600"><i data-lucide="trash-2" class="w-4 h-4"></i></button>
                                            </div>
                                        </div>
                                        <h4 class="font-bold text-slate-800 mt-2">Pembangunan Infrastruktur</h4>
                                        <p class="text-xs text-slate-500 mt-1 line-clamp-2 leading-relaxed">Fokus pembangunan jalan poros desa dan irigasi pertanian.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 4. TAB STRUKTUR -->
                        <div id="tab-struktur" class="tab-content hidden animate-fade-in text-center">
                            <h3 class="text-lg font-bold text-slate-800 mb-6">Bagan Struktur Organisasi</h3>
                            
                            <div class="max-w-4xl mx-auto">
                                <div class="relative group rounded-xl overflow-hidden shadow-xl border border-slate-200 mb-8 bg-slate-100">
                                    <img src="https://img.freepik.com/free-vector/gradient-organizational-chart-template_23-2149442082.jpg?w=1380" class="w-full object-cover transition duration-500 group-hover:opacity-90">
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300 bg-black/20">
                                        <a href="#" class="bg-white text-slate-900 px-6 py-2 rounded-full font-bold shadow-lg hover:scale-105 transition flex items-center gap-2">
                                            <i data-lucide="zoom-in" class="w-4 h-4"></i> Lihat Full Size
                                        </a>
                                    </div>
                                </div>

                                <div class="bg-white p-6 rounded-xl border border-slate-200 shadow-sm inline-block w-full max-w-lg">
                                    <h4 class="font-bold text-slate-700 mb-4">Perbarui Gambar Struktur</h4>
                                    <form onsubmit="event.preventDefault(); showSuccess();">
                                        <div class="flex items-center gap-3">
                                            <input type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100 border border-slate-300 rounded-full cursor-pointer bg-slate-50">
                                            <button type="submit" class="bg-emerald-600 text-white px-6 py-2.5 rounded-full font-bold shadow hover:bg-emerald-700 transition flex items-center gap-2">
                                                <i data-lucide="upload" class="w-4 h-4"></i> Upload
                                            </button>
                                        </div>
                                    </form>
                                    <p class="text-xs text-slate-400 mt-3">Disarankan format PNG/JPG resolusi tinggi (min. 1920px width).</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>

    <!-- JAVASCRIPT Logic -->
    <script>
        // Initialize Icons
        lucide.createIcons();

        // 1. Logic Tab Switcher
        function switchTab(tabId) {
            // Hide all contents
            document.querySelectorAll('.tab-content').forEach(el => el.classList.add('hidden'));
            // Remove active styles from all buttons
            document.querySelectorAll('.tab-btn').forEach(el => {
                el.classList.remove('active-tab', 'text-emerald-600', 'border-emerald-500');
                el.classList.add('text-slate-600', 'border-transparent');
                
                // Reset icon color
                const icon = el.querySelector('svg');
                if(icon) icon.style.color = 'currentColor';
            });

            // Show selected content
            const selectedContent = document.getElementById('tab-' + tabId);
            selectedContent.classList.remove('hidden');

            // Add active style to selected button
            const activeBtn = document.getElementById('btn-' + tabId);
            activeBtn.classList.add('active-tab');
            activeBtn.classList.remove('text-slate-600', 'border-transparent');
        }

        // 2. Logic Toggle Form Sejarah
        function toggleHistoryForm() {
            const form = document.getElementById('history-form');
            form.classList.toggle('hidden');
        }

        // 3. Logic Mockup Success Notification
        function showSuccess() {
            const notif = document.getElementById('notification');
            notif.classList.remove('hidden');
            notif.scrollIntoView({ behavior: 'smooth', block: 'start' });
            
            // Auto hide after 3 seconds
            setTimeout(() => {
                notif.classList.add('hidden');
            }, 3000);
        }

        // Set default tab
        document.addEventListener('DOMContentLoaded', () => {
            switchTab('umum');
        });
    </script>
</body>
</html>