<!-- ========================================== -->
<!-- MODAL KONFIRMASI HAPUS JURNAL -->
<!-- ========================================== -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background: #1e293b; border: 1px solid rgba(255,255,255,0.05); border-radius: 16px; box-shadow: 0 25px 50px -12px rgba(0,0,0,0.5);">
            
            <!-- ===== HEADER ===== -->
            <div class="modal-header" style="border-bottom: 1px solid rgba(255,255,255,0.05); padding: 20px 24px;">
                <div class="d-flex align-items-center gap-3">
                    <!-- Icon Trash -->
                    <div style="width: 48px; height: 48px; background: rgba(239, 68, 68, 0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        <i class="fas fa-trash-alt" style="color: #ef4444; font-size: 1.4rem;"></i>
                    </div>
                    <div>
                        <h5 class="modal-title text-white" id="deleteModalLabel" style="font-weight: 700; font-size: 1.2rem; margin: 0;">
                            Hapus Jurnal
                        </h5>
                        <p class="text-muted" style="margin: 0; font-size: 0.85rem; color: #94a3b8;">
                            <i class="fas fa-exclamation-circle me-1"></i> Data yang dihapus tidak dapat dikembalikan
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- ===== BODY ===== -->
            <div class="modal-body" style="padding: 24px;">
                <!-- Peringatan -->
                <div style="background: rgba(239, 68, 68, 0.05); border: 1px solid rgba(239, 68, 68, 0.1); border-radius: 12px; padding: 16px; margin-bottom: 16px;">
                    <p style="color: #e2e8f0; margin: 0; font-size: 1rem;">
                        <i class="fas fa-question-circle me-2" style="color: #ef4444;"></i>
                        Apakah Anda yakin ingin menghapus jurnal ini?
                    </p>
                </div>

                <!-- Detail Jurnal yang Akan Dihapus -->
                <div style="background: rgba(255,255,255,0.03); border-radius: 10px; padding: 14px 16px; border: 1px solid rgba(255,255,255,0.05);">
                    <div style="display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid rgba(255,255,255,0.03);">
                        <span style="color: #94a3b8; font-size: 0.85rem;">
                            <i class="fas fa-user me-2" style="width: 16px;"></i> Guru
                        </span>
                        <span style="color: #f8fafc; font-weight: 500; font-size: 0.9rem;" id="deleteTeacherName">-</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 6px 0; border-bottom: 1px solid rgba(255,255,255,0.03);">
                        <span style="color: #94a3b8; font-size: 0.85rem;">
                            <i class="fas fa-users me-2" style="width: 16px;"></i> Kelas
                        </span>
                        <span style="color: #f8fafc; font-weight: 500; font-size: 0.9rem;" id="deleteClass">-</span>
                    </div>
                    <div style="display: flex; justify-content: space-between; padding: 6px 0;">
                        <span style="color: #94a3b8; font-size: 0.85rem;">
                            <i class="fas fa-calendar-alt me-2" style="width: 16px;"></i> Tanggal
                        </span>
                        <span style="color: #f8fafc; font-weight: 500; font-size: 0.9rem;" id="deleteDate">-</span>
                    </div>
                </div>
            </div>

            <!-- ===== FOOTER ===== -->
            <div class="modal-footer" style="border-top: 1px solid rgba(255,255,255,0.05); padding: 16px 24px;">
                <button type="button" class="btn" data-bs-dismiss="modal" style="background: rgba(255,255,255,0.05); color: #94a3b8; border: 1px solid rgba(255,255,255,0.05); border-radius: 10px; padding: 8px 24px; font-weight: 600; transition: all 0.2s;">
                    <i class="fas fa-times me-2"></i> Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn" style="background: #ef4444; color: white; border-radius: 10px; padding: 8px 24px; font-weight: 600; transition: all 0.2s; border: none;">
                        <i class="fas fa-trash-alt me-2"></i> Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- JAVASCRIPT UNTUK MODAL -->
<!-- ========================================== -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var deleteButtons = document.querySelectorAll('.btn-delete-journal');
        var deleteModal = document.getElementById('deleteModal');
        var deleteForm = document.getElementById('deleteForm');
        var deleteTeacherName = document.getElementById('deleteTeacherName');
        var deleteClass = document.getElementById('deleteClass');
        var deleteDate = document.getElementById('deleteDate');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var url = this.getAttribute('data-url');
                var teacher = this.getAttribute('data-teacher');
                var className = this.getAttribute('data-class');
                var date = this.getAttribute('data-date');

                deleteTeacherName.textContent = teacher || '-';
                deleteClass.textContent = className || '-';
                deleteDate.textContent = date || '-';
                deleteForm.action = url;

                var modal = new bootstrap.Modal(deleteModal);
                modal.show();
            });
        });
    });
</script>