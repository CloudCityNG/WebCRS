function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
	//change document to only the required div
     document.body.innerHTML = printContents;
	//print the div
     window.print();
	//change back to original contents
     document.body.innerHTML = originalContents;
     //after previous content is added to document. body
     //page needs to be reloated
     //post method reload ask for user verification
     //code below reloads page my get method in background
      window.location.href = window.location.pathname + window.location.search;
}
