var script_upload=tinyMCE.settings.script_image_upload;

function MultiSelector( list_target, max ){
	// Where to write the list
	this.list_target = list_target;
	this.list_file=new Array();
	// How many elements?
	this.count = 0;
	// How many elements?
	this.id = 0;
	// Is there a maximum?
	if( max ){
		this.max = max;
	} else {
		this.max = -1;
	};
	
	/**
	 * Add a new file input element
	 */
	this.addElement = function( element ){

		// Make sure it's a file input element
		if( element.tagName == 'INPUT' && element.type == 'file' ){

			// Element name -- what number am I?
			element.name = 'ImgFile[]';

			// Add reference to this object
			element.multi_selector = this;

			// What to do when a file is selected
			element.onchange = function(){
				for(fi in this.multi_selector.list_file)
				{
					if(this.multi_selector.list_file[fi]==this.value)
					{
						this.value='';
						alert("This file choosed");
						return;
					}
				}
				this.multi_selector.list_file[this.multi_selector.count]=this.value;
				// New file input
				var new_element = document.createElement( 'input' );
				new_element.type = 'file';
				new_element.name = 'ImgFile[]';

				// Add new element
				this.parentNode.appendChild( new_element, this );

				// Apply 'update' to element
				this.multi_selector.addElement( new_element );

				// Update list
				this.multi_selector.addListRow( this );

				// Hide this: we can't use display:none because Safari doesn't like it
				this.style.position = 'absolute';
				this.style.left = '-1000px';

			};
			// If we've reached maximum number, disable input element
			if( this.max != -1 && this.count >= this.max ){
				element.disabled = true;
			};

			// File element counter
			this.count++;
			// Most recent element
			this.current_element = element;
			
		} else {
			// This can only be applied to file input elements!
			alert( 'Error: not a file input element' );
		};

	};

	/**
	 * Add a new row to the list of files
	 */
	this.addListRow = function( element ){

		// Row div
		var new_row = document.createElement( 'div' );
		new_row.className='listdivimgup';
		
		var new_row_div=document.createElement( 'div' );
		new_row_div.className='listimgfileup';
		
		//input change name file
		var new_row_input=document.createElement( 'input' );
		new_row_input.name='newname[]';
		new_row_input.value=element.value;
		new_row_input.className='disachangevl';
		new_row_input.title='Click here to change name';
		new_row_input.onfocus=function(){
			this.className='enabchangevl';
			arr=(/^(.*)\.(.{3,4})$/i).exec(this.value);
			this.value=arr[1];
			this.oldname=arr[1];
			this.arge="."+arr[2];
		};
		new_row_input.onblur=function(){
			new_row_input.className='disachangevl';
			if(this.value=="")this.value=this.oldname;
			this.value+=this.arge;
			
		};
		//status:
		var new_row_status=document.createElement( 'span' );
		new_row_status.id=element.value;
		new_row_status.className='statusup';
		new_row_status.innerHTML='--';
		
		// Delete button
		var new_row_button = document.createElement( 'input' );
		new_row_button.type = 'button';
		new_row_button.value = 'Delete';
		new_row_button.className='butdelup';

		// References
		new_row.element = element;

		// Delete function
		new_row_button.onclick= function(){
			for(i in this.parentNode.element.multi_selector.list_file)
			{
				if(this.parentNode.element.multi_selector.list_file[i]==this.parentNode.element.value)
				{
					this.parentNode.element.multi_selector.list_file[i]='';
				}
			}
			// Remove element from form
			this.parentNode.element.parentNode.removeChild( this.parentNode.element );

			// Remove this row from the list
			this.parentNode.parentNode.removeChild( this.parentNode );

			// Decrement counter
			this.parentNode.element.multi_selector.count--;

			// Re-enable input element (if it's disabled)
			this.parentNode.element.multi_selector.current_element.disabled = false;
			
			if(this.parentNode.element.multi_selector.count<=1)
			{
				document.getElementById("butupload").value="Upload";
				document.getElementById("butupload").style.display="";
			}
			// Appease Safari
			//    without it Safari wants to reload the browser window
			//    which nixes your already queued uploads
			return false;
		};	
		new_row_div.appendChild(new_row_input);
		new_row.appendChild( new_row_div );
		new_row.appendChild(new_row_status);
		// Add button
		new_row.appendChild( new_row_button );

		// Add it to the list
		this.list_target.appendChild( new_row );
		
	};
};

function checkupload(f)
{
	if(document.getElementById("butupload").value!="Uploading...")
	{
		document.getElementById("butupload").value="Uploading...";
	}else
	{
		return false;
	}
	document.getElementById("error").innerHTML="";
	f.action=script_upload+'?opt=upload';
	return true;
}
function uploadsuccess(bl,msg)
{
	document.getElementById("butupload").value="Upload";
	if(bl==true)
	{
		arr=msg.split("^^");
		for(i in arr)
		{
			arr2=arr[i].split("|");
			obj=document.getElementById(arr2[0]);
			if(obj){
				obj.innerHTML=arr2[1];
				obj.title=arr2[2];
			}
		}
		document.getElementById("butupload").style.display="none";
		f = tinyMCEPopup.getWindowArg('func');
		tinyMCEPopup.restoreSelection();
		if (f)f();
		return;
	}
	document.getElementById("error").innerHTML=msg;
}