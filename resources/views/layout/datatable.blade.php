@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    /* Style untuk highlight hijau */
    .kmp-highlight {
        background-color: #28a745;
        color: white;
        border-radius: 2px;
        padding: 0 2px;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        let table = $('#datatable-arsip').DataTable({
            pageLength: 10,
            lengthChange: true,
            ordering: true,
            searching: true,
            dom: 'lrtip'
        });

        $('#arsip-search').on('keyup', function() {
            let keyword = this.value;
            let startTime = performance.now(); // Mulai hitung durasi

            // 1. Eksekusi Pencarian DataTable
            table.search(keyword).draw();

            let endTime = performance.now(); // Selesai hitung durasi
            let duration = ((endTime - startTime) / 1000).toFixed(10);

            // 2. Update Info Panel
            if (keyword.length > 0) {
                $('#search-info').removeClass('d-none');
                $('#search-keyword').text(keyword);
                $('#search-duration').text(duration);

                // 3. Logika Highlighting (Real-time warna hijau)
                applyHighlight(keyword);
            } else {
                $('#search-info').addClass('d-none');
                clearHighlight();
            }
        });

        function applyHighlight(keyword) {
            clearHighlight(); // Bersihkan highlight sebelumnya

            if (!keyword) return;

            let regex = new RegExp('(' + keyword.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&") + ')', 'ig');

            // Scan semua baris yang terlihat di tabel
            $('#datatable-arsip tbody tr').each(function() {
                $(this).find('td').each(function() {
                    let text = $(this).html();
                    // Cegah merusak tag HTML jika ada (seperti icon atau button)
                    if (!text.includes('<button') && !text.includes('<a')) {
                        let newText = text.replace(regex, '<span class="kmp-highlight">$1</span>');
                        $(this).html(newText);
                    }
                });
            });
        }

        function clearHighlight() {
            $('#datatable-arsip tbody tr td span.kmp-highlight').each(function() {
                $(this).replaceWith($(this).text());
            });
        }

        // Pastikan highlight tetap ada saat ganti halaman (pagination)
        table.on('draw', function() {
            let keyword = $('#arsip-search').val();
            if (keyword) applyHighlight(keyword);
        });
    });
</script>
@endpush