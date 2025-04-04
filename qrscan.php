<h2>QR Scanner</h2>
<div id="reader" style="width: 300px;"></div>
<p>Scanned Result: <span id="result"></span></p>

<script src="https://unpkg.com/html5-qrcode"></script>
<script>
    const qr = new Html5Qrcode("reader");
    qr.start(
        { facingMode: "environment" },
        { fps: 10, qrbox: 250 },
        (decodedText) => {
            document.getElementById("result").textContent = decodedText;
            qr.stop(); // stop scanner
        },
        (error) => { /* ignore errors */ }
    );
</script>
