<style>
.lang-switcher {
    position: relative;
    display: inline-block;
    font-weight: bold;
    font-size: 0.9rem;
}

.lang-switcher button {
    background-color: #fff;
    color: #2f4ae8;
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 5px;
}

.lang-switcher button::after {
    content: "▼";
    font-size: 0.6rem;
    margin-left: 5px;
}

.lang-switcher .dropdown {
    display: none;
    position: absolute;
    background-color: #fff;
    min-width: 120px;
    box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
    z-index: 1;
    border-radius: 4px;
    overflow: hidden;
}

.lang-switcher .dropdown a {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 8px 12px;
    text-decoration: none;
    color: #2f4ae8;
    transition: background-color 0.3s;
}

.lang-switcher .dropdown a:hover {
    background-color: #f0f0f0;
}

.lang-switcher.show .dropdown {
    display: block;
}

.flag {
    width: 16px;
    height: 12px;
}
</style>

<div class="lang-switcher" id="langSwitcher">
    <button id="langBtn">
        @php $locale = app()->getLocale(); @endphp
        @if($locale == 'fr')
            <img src="https://flagcdn.com/16x12/fr.png"
                 srcset="https://flagcdn.com/32x24/fr.png 2x,
                         https://flagcdn.com/48x36/fr.png 3x"
                 width="16" height="12" alt="Français" class="flag"> FR
        {{-- @elseif($locale == 'en')
            <img src="https://flagcdn.com/16x12/gb.png"
                 srcset="https://flagcdn.com/32x24/gb.png 2x,
                         https://flagcdn.com/48x36/gb.png 3x"
                 width="16" height="12" alt="English" class="flag"> EN --}}
        @elseif($locale == 'ar')
            <img src="https://flagcdn.com/16x12/sa.png"
                 srcset="https://flagcdn.com/32x24/sa.png 2x,
                         https://flagcdn.com/48x36/sa.png 3x"
                 width="16" height="12" alt="العربية" class="flag"> AR
        @endif
    </button>
    <div class="dropdown">
        <a href="{{ route('langue.choisir', 'fr') }}">
            <img src="https://flagcdn.com/16x12/fr.png"
                 srcset="https://flagcdn.com/32x24/fr.png 2x,
                         https://flagcdn.com/48x36/fr.png 3x"
                 width="16" height="12" alt="Français" class="flag"> Français
        </a>
        {{-- <a href="{{ route('langue.choisir', 'en') }}">
            <img src="https://flagcdn.com/16x12/gb.png"
                 srcset="https://flagcdn.com/32x24/gb.png 2x,
                         https://flagcdn.com/48x36/gb.png 3x"
                 width="16" height="12" alt="English" class="flag"> English
        </a> --}}
        <a href="{{ route('langue.choisir', 'ar') }}">
            <img src="https://flagcdn.com/16x12/sa.png"
                 srcset="https://flagcdn.com/32x24/sa.png 2x,
                         https://flagcdn.com/48x36/sa.png 3x"
                 width="16" height="12" alt="العربية" class="flag"> العربية
        </a>
    </div>
</div>

<script>
document.getElementById('langBtn').addEventListener('click', function() {
    document.getElementById('langSwitcher').classList.toggle('show');
});

window.addEventListener('click', function(e) {
    if (!document.getElementById('langSwitcher').contains(e.target)) {
        document.getElementById('langSwitcher').classList.remove('show');
    }
});
</script>
