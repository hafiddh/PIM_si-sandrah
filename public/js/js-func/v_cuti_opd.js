$(document).ready(function () {
  loadData();

  $(".select2").select2();

  $(".sudah_pilih").prop("disabled", true);
  $(".edit_view").prop("disabled", true);
  $("#btn_foot").hide(200);
});


function format(inputDate) {
  let date, month, year;

  date = inputDate.getDate();
  month = inputDate.getMonth() + 1;
  year = inputDate.getFullYear();

  date = date.toString().padStart(2, "0");

  month = month.toString().padStart(2, "0");

  return `${date}-${month}-${year}`;
}

$("#tgl_awal").on("change", function () {
  var start = new Date($("#tgl_awal").val());
  var end = new Date($("#tgl_akhir").val());
  var diff = new Date(end - start);
  var days = diff / 1000 / 60 / 60 / 24;
  $("#diff_hari").val(days);
  $("#diff_hari_con").val(days);
});

$("#tgl_akhir").on("change", function () {
  var start = new Date($("#tgl_awal").val());
  var end = new Date($("#tgl_akhir").val());
  var diff = new Date(end - start);
  var days = diff / 1000 / 60 / 60 / 24;
  $("#diff_hari_con").val(days);
  $("#diff_hari").val(days);
});

$("#modal_cuti").click(function () {
  $("#modal_add_cuti").modal("show");
});

$("#peg_pilihan").on("change", function () {
  var id_peg = $("#peg_pilihan option:selected").val();
  $.ajax({
    url: "{{ route('opd.get.pegawai') }}",
    type: "get",
    data: {
      id: id_peg,
    },
    success: function (data) {
      $("#id_pegawai").val(data.id_pegawai);
      $("#nama").val(data.nama_pegawai);
      $("#nip").val(data.nip);
      $("#jabatan").val(data.jabatan);
      $("#masa1").val(data.mk_thn);
      $("#masa2").val(data.mk_bln);
      $("#unit").val(data.nama_opd);
      $(".sudah_pilih").prop("disabled", false);
    },
    error: function (error) {
      console.log(error);
      error_detail(error);
    },
  });

  $.ajax({
    url: "{{ route('opd.get.pegawai.cuti') }}",
    type: "get",
    data: {
      id: id_peg,
    },
    success: function (data) {
      value = 12 - data;
      $("#jum_t").val(data);
      $("#sisa_t").val(value);
      $("#sisa_t_con").val(value);
    },
    error: function (error) {
      console.log(error);
      error_detail(error);
    },
  });
});

$("#butt_sub").click(function () {
  err1 = $("#diff_hari").val();
  err2 = $("#sisa_t").val();
  err4 = $("#jenis_c").val();
  err3 = err2 - err1;
  if (err4 == 1) {
    if (err3 <= 0) {
      alert("Jumlah hari cuti telah melebihi kuota Cuti");
    } else {
      $("#form_add").submit();
    }
  } else {
    $("#form_add").submit();
  }
});

function loadData() {
  $("#datatable33").DataTable({
    paging: false,
    destroy: true,
    info: true,
    searching: true,
    autoWidth: false,
    processing: true,
    serverSide: true,
    ajax: {
      url: "{{ route('opd.get.cuti') }}",
      type: "GET",
    },
    aoColumnDefs: [
      {
        bSortable: false,
        aTargets: [3, 4, 6, 7],
      },
      {
        bSearchable: false,
        aTargets: [3, 4, 6, 7],
      },
    ],
    columns: [
      {
        data: null,
        sortable: false,
        render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
        },
      },
      {
        data: "nip",
      },
      {
        data: "nama_pegawai",
      },
      {
        data: null,
        render: function (data, type, row) {
          if (data.jenis_cuti == 1) {
            return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Tahunan</span>';
          } else if (data.jenis_cuti == 2) {
            return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Besar</span>';
          } else if (data.jenis_cuti == 3) {
            return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Sakit</span>';
          } else if (data.jenis_cuti == 4) {
            return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Melahirkan</span>';
          } else if (data.jenis_cuti == 5) {
            return '<span class="badge badge-pill badge-lg light badge-success"> Cuti Alasan Penting</span>';
          } else if (data.jenis_cuti == 6) {
            return '<span class="badge badge-pill badge-lg light badge-success"> Cuti di Luar Tanggungan Negara</span>';
          }
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          result = format(new Date(data.tgl_awal));
          result2 = format(new Date(data.tgl_akhir));
          return "" + result + "  s/d  " + result2;
        },
      },
      {
        data: "created_at",
        render: function (data, type, row) {
          result = format(new Date(data));
          return "" + result;
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (data.status == 0) {
            return '<span class="badge badge-pill badge-lg light badge-info"><i class="fa fa-exclamation-triangle"></i> Menunggu Proses</span>';
          } else if (data.status == 1) {
            return '<span class="badge badge-pill badge-lg light badge-danger"><i class="fa fa-times"></i> Selesai (Ditolak) </span>';
          } else if (data.status == 2) {
            return '<span class="badge badge-pill badge-lg light badge-success"><i class="fa fa-check"></i> Selesai (Diterima)</span>';
          }
        },
      },
      {
        data: null,
        render: function (data, type, row) {
          if (data.status != 2) {
            return (
              "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
              data.id +
              "' onClick='info_det(this.id)'><i class='fa fa-search'></i>" +
              "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-info'  id='" +
              data.id +
              "' onClick='info_edit(this.id)'><i class='fa fa-edit'></i>" +
              "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-danger'  id='" +
              data.id +
              "' onClick='info_hapus(this.id)'><i class='fa fa-trash'></i></button>&nbsp;"
            );
          } else {
            return (
              "<button style='margin-bottom:5px;' type='button' class='btn btn-sm btn-outline-success'  id='" +
              data.id +
              "' onClick='info_det(this.id)'><i class='fa fa-search'></i>"
            );
          }
        },
      },
    ],
  });
}

function info_edit(clicked_id) {
  $("#modal_edit_cuti").modal("show");
  $(".edit_view").prop("disabled", false);
  $(".edit_view_eee").prop("disabled", true);
  $("#btn_foot").show(200);

  $.ajax({
    url: "{{ route('opd.get.cuti.det') }}",
    type: "get",
    data: {
      id: clicked_id,
    },
    success: function (data) {
      $("#e_id").val(data.id);
      $("#e_nama").val(data.nama_pegawai);
      $("#e_nip").val(data.nip);
      $("#e_jabatan").val(data.jabatan);
      $("#e_masa1").val(data.mk_thn);
      $("#e_masa2").val(data.mk_bln);
      $("#e_jenis_c").val(data.jenis_cuti).change();
      $("#e_alasan_c").val(data.alasan);
      $("#e_tgl_awal").val(data.tgl_awal);
      $("#e_tgl_akhir").val(data.tgl_akhir);
      $("#e_diff_hari").val(data.lama_c);
      $("#e_jum_t").val(0);
      $("#e_sisa_t").val(0);
      $("#e_catatan_c_t").val(data.catatan_c_t);
      $("#e_catatan_c_b").val(data.catatan_c_b);
      $("#e_catatan_c_s").val(data.catatan_c_s);
      $("#e_catatan_c_m").val(data.catatan_c_m);
      $("#e_catatan_c_ap").val(data.catatan_c_ap);
      $("#e_catatan_c_cdlt").val(data.catatan_c_dlt);
      $("#e_alamat_c").val(data.alamat);
      $("#e_notelp_c").val(data.nomor_telp);
    },
    error: function (error) {
      console.log(error);
      error_detail(error);
    },
  });
}

function info_det(clicked_id) {
  $("#modal_edit_cuti").modal("show");
  $(".edit_view").prop("disabled", true);
  $(".edit_view_eee").prop("disabled", true);
  $("#btn_foot").hide(200);

  $.ajax({
    url: "{{ route('opd.get.cuti.det') }}",
    type: "get",
    data: {
      id: clicked_id,
    },
    success: function (data) {
      $("#e_id").val(data.id);
      $("#e_nama").val(data.nama_pegawai);
      $("#e_nip").val(data.nip);
      $("#e_jabatan").val(data.jabatan);
      $("#e_masa1").val(data.mk_thn);
      $("#e_masa2").val(data.mk_bln);
      $("#e_jenis_c").val(data.jenis_cuti).change();
      $("#e_alasan_c").val(data.alasan);
      $("#e_tgl_awal").val(data.tgl_awal);
      $("#e_tgl_akhir").val(data.tgl_akhir);
      $("#e_diff_hari").val(data.lama_c);
      $("#e_jum_t").val(0);
      $("#e_sisa_t").val(0);
      $("#e_catatan_c_t").val(data.catatan_c_t);
      $("#e_catatan_c_b").val(data.catatan_c_b);
      $("#e_catatan_c_s").val(data.catatan_c_s);
      $("#e_catatan_c_m").val(data.catatan_c_m);
      $("#e_catatan_c_ap").val(data.catatan_c_ap);
      $("#e_catatan_c_cdlt").val(data.catatan_c_dlt);
      $("#e_alamat_c").val(data.alamat);
      $("#e_notelp_c").val(data.nomor_telp);
    },
    error: function (error) {
      console.log(error);
      error_detail(error);
    },
  });
}

function info_hapus(clicked_id) {
  // alert(clicked_id);
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      confirmButton: "btn btn-success",
      cancelButton: "btn btn-danger",
    },
    buttonsStyling: false,
  });

  swalWithBootstrapButtons
    .fire({
      title: "Data akan dihapus?",
      text: "Data dihapus tidak dapat dikembalikan!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonText: "Ya, hapus",
      cancelButtonText: "Tidak, batalkan",
      reverseButtons: true,
    })
    .then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          url: "{{ route('opd.hapus.cuti') }}",
          type: "get",
          data: {
            id: clicked_id,
          },
        });
        loadData();
        swalWithBootstrapButtons.fire(
          "Terhapus!",
          "Data Berhasil diHapus!.",
          "success"
        );
      } else if (
        /* Read more about handling dismissals below */
        result.dismiss === Swal.DismissReason.cancel
      ) {
        swalWithBootstrapButtons.fire("Dibatalkan", "", "error");
      }
    });
}
