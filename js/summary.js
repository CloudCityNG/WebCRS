function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
	//change document to only the required div
     document.body.innerHTML = printContents;
	//print the div
     window.print();
	//change back to original contents
     document.body.innerHTML = originalContents;
}
