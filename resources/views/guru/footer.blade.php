<!-- Footer Guru -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-left">
            &copy; {{ date('Y') }} Jurnal Mengajar Guru
        </div>
        <div class="footer-right">
            <span>SMK Negeri 1 Banjarmasin</span>
            <span class="separator">|</span>
            <span>v1.0</span>
        </div>
    </div>
</footer>

<style>
    .footer {
        background: rgba(15, 23, 42, 0.8);
        border-top: 1px solid rgba(255, 255, 255, 0.05);
        padding: 12px 24px;
        margin-top: auto;
    }

    .footer-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        max-width: 1400px;
        margin: 0 auto;
        font-size: 0.8rem;
        color: #64748b;
    }

    .footer-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .footer-right .separator {
        color: #334155;
    }

    @media (max-width: 480px) {
        .footer-container {
            flex-direction: column;
            gap: 4px;
            text-align: center;
        }
    }
</style>