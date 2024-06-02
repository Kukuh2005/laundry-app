<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                <div class="app-brand demo">
                    <a href="/{{auth()->user()->level}}/dashboard" class="app-brand-link">
                        <span class="app-brand-logo demo">
                        </span>
                        <span class="app-brand-text demo menu-text fw-bolder text-primary" style="width: 100%">{{$outlet->nama}}</span>
                    </a>

                    <a href="javascript:void(0);"
                        class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
                        <i class="bx bx-chevron-left bx-sm align-middle"></i>
                    </a>
                </div>

                <div class="menu-inner-shadow"></div>

                <ul class="menu-inner py-1">
                    <!-- Dashboard -->
                    <li class="menu-item">
                        <a href="/{{auth()->user()->level}}/dashboard" class="menu-link">
                            <i class="fas fa-tachometer-alt me-3"></i>
                            <div data-i18n="Analytics">Dashboard</div>
                        </a>
                    </li>

                    <!-- Layouts -->
                    <li class="menu-item">
                        <a href="javascript:void(0);" class="menu-link menu-toggle">
                            <i class="fas fa-table me-3"></i>
                            <div data-i18n="Layouts">Data Master</div>
                        </a>
                        
                        <ul class="menu-sub">
                            @if(auth()->user()->level == 'Admin' || auth()->user()->level == 'Pemilik')
                            <li class="menu-item">
                                <a href="/{{auth()->user()->level}}/paket" class="menu-link">
                                    <div data-i18n="Without navbar">Paket</div>
                                </a>
                            </li>
                            @endif
                            <li class="menu-item">
                                <a href="/{{auth()->user()->level}}/pelanggan" class="menu-link">
                                    <div data-i18n="Container">Pelanggan</div>
                                </a>
                            </li>
                        </ul>
                    </li>

                    @if(auth()->user()->level == 'Karyawan' || auth()->user()->level == 'Pemilik')
                    <li class="menu-item">
                        <a href="/{{auth()->user()->level}}/transaksi" class="menu-link">
                            <i class="fas fa-shopping-cart me-3"></i>
                            <div data-i18n="Analytics">Transaksi</div>
                        </a>
                    </li>
                    
                    <li class="menu-item">
                        <a href="/{{auth()->user()->level}}/order" class="menu-link">
                            <i class="fas fa-truck me-3"></i>
                            <div data-i18n="Analytics">Order</div>
                        </a>
                    </li>
                    @endif
                    @if(auth()->user()->level == 'Admin' || auth()->user()->level == 'Pemilik')
                    <li class="menu-item">
                        <a href="/{{auth()->user()->level}}/laporan" class="menu-link">
                            <i class="fas fa-file me-3"></i>
                            <div data-i18n="Analytics">Laporan</div>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="/{{auth()->user()->level}}/karyawan" class="menu-link">
                            <i class="fas fa-users me-3"></i>
                            <div data-i18n="Analytics">Karyawan</div>
                        </a>
                    </li>
                    @endif
                </ul>
            </aside>