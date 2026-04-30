<?php if($msg=="approved"){ ?>
<div class="popup-bg" id="popup">
<div class="popup-box">
<h3>✅ Approved</h3>
<p>Leave Approved Successfully</p>
<button onclick="closePopup()">OK</button>
</div>
</div>
<?php } ?>

<?php if($msg=="rejected"){ ?>
<div class="popup-bg" id="popup">
<div class="popup-box">
<h3>❌ Rejected</h3>
<p>Leave Rejected Successfully</p>
<button onclick="closePopup()">OK</button>
</div>
</div>
<?php } ?>

<script src="js/admin-popup.js"></script>

</body>
</html>