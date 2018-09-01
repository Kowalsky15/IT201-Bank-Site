<!DOCTYPE html5>
<form action = "transact.php">
<fieldset style = "margin : auto; width : 70%; background-color: blue"><h1>Transaction Submission</h1>
<input type ="text" name = "amount"
       autocomplete = "off"
       placeholder = "Enter Amount"
       required
       autofocus = "on">Amount<br><br>
<input type="radio" name="transaction" value="D">Deposit<br><br>
<input type="radio" name="transaction" value="W">Withdraw<br><br>
<input type ="checkbox" name = "email">Email<br><br>
<input type="submit">
</fieldset>
</form>