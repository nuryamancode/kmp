@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<style>
    .kmp-highlight {
        background-color: #28a745 !important;
        color: white !important;
        border-radius: 2px;
        padding: 0 2px;
        font-weight: bold;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    // Preprocessing Pola (Bagian atas flowchart)
    // Menghasilkan Longest Proper Prefix yang juga Suffix (LPS)
    function computeLPSArray(pattern) {
        let m = pattern.length;
        let lps = new Array(m).fill(0);
        let len = 0; // panjang prefix sebelumnya
        let i = 1;

        while (i < m) {
            if (pattern[i].toLowerCase() === pattern[len].toLowerCase()) {
                len++;
                lps[i] = len; // Nilai prefix melakukan increment
                i++;
            } else {
                if (len !== 0) {
                    len = lps[len - 1]; // Lanjut ke perbandingan selanjutnya
                } else {
                    lps[i] = 0; // Nilai prefix pada posisi index[j] = 0
                    i++;
                }
            }
        }
        return lps;
    }

    // Pencarian KMP (Bagian bawah flowchart)
    function kmpSearch(pattern, text) {
        if (!pattern) return false;

        let n = text.length;
        let m = pattern.length;
        let lps = computeLPSArray(pattern);
        let i = 0; // index untuk teks
        let j = 0; // index untuk pola

        while (i < n) {
            if (pattern[j].toLowerCase() === text[i].toLowerCase()) {
                i++;
                j++;
            }

            if (j === m) {
                return true; // Pola ditemukan (Proses KMP Selesai)
            } else if (i < n && pattern[j].toLowerCase() !== text[i].toLowerCase()) {
                if (j !== 0) {
                    j = lps[j - 1]; // Geser berdasarkan nilai prefix
                } else {
                    i++;
                }
            }
        }
        return false;
    }

    function applyHighlight(keyword) {
        clearHighlight();
        if (!keyword) return;

        // Escape keyword untuk regex agar tidak error jika ada karakter khusus
        let escapedKeyword = keyword.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&");
        let regex = new RegExp('(' + escapedKeyword + ')', 'ig');

        $('#datatable-arsip tbody tr:visible td').each(function() {
            let html = $(this).html();
            // Jaga agar tidak merusak elemen dropdown, icon, atau tombol
            if (!html.includes('<button') && !html.includes('<a') && !html.includes('<i')) {
                $(this).html(html.replace(regex, '<span class="kmp-highlight">$1</span>'));
            }
        });
    }

    function clearHighlight() {
        $('.kmp-highlight').each(function() {
            $(this).replaceWith($(this).text());
        });
    }

    $(document).ready(function() {
        // Mencegah re-initialise error
        if ($.fn.DataTable.isDataTable('#datatable-arsip')) {
            $('#datatable-arsip').DataTable().destroy();
        }

        let table = $('#datatable-arsip').DataTable({
            pageLength: 10,
            lengthChange: true,
            ordering: true,
            searching: true, // Tetap true agar internal API draw() berfungsi
            dom: 'lrtip' // Sembunyikan input search box default datatables
        });

        // Hubungkan DataTables Filter dengan Logika KMP
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                let keyword = $('#arsip-search').val();
                if (!keyword) return true;

                // Cek KMP pada kolom Jenis(1), Kategori(2), dan Tipe(3)
                let contentToSearch = data[1] + " " + data[2] + " " + data[3];
                return kmpSearch(keyword, contentToSearch);
            }
        );

        // Handler saat user mengetik
        $('#arsip-search').on('keyup', function() {
            let keyword = this.value;
            let t0 = performance.now();

            // Trigger filtrasi (ini akan memanggil kmpSearch via push di atas)
            table.draw();

            let t1 = performance.now();
            let duration = ((t1 - t0) / 1000).toFixed(10);

            if (keyword.length > 0) {
                $('#search-info').removeClass('d-none');
                $('#search-keyword').text(keyword);
                $('#search-duration').text(duration);
                applyHighlight(keyword);
            } else {
                $('#search-info').addClass('d-none');
                clearHighlight();
            }
        });

        // Re-apply highlight saat navigasi pagination
        table.on('draw', function() {
            let keyword = $('#arsip-search').val();
            if (keyword) applyHighlight(keyword);
        });
    });
</script>
@endpush