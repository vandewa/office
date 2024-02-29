<div>
    <button onclick="fungsiSaya()">Klik Saya</button>

<div id="target">
  Simpan Objek apapun disini untuk dihilangkan/dimunculkan.
</div>

<script>
function fungsiSaya() {
  var x = document.getElementById("target");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
</div>
