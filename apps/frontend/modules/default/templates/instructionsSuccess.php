
<h4>Here are some instructions to get started with <?= sfConfig::get('app_project_name') ?>!</h4>	

<div class="block">
	<div class="column border span-10 append-1 prepend-1">
        <h3>Phone with SMS</h3>
        <ol>
            <li>Add <code>+1 310 848 7807</code> to your Contacts</li>
            <li>
                For SMS to function correctly you must abide by the following syntax:
                <pre><?= include_partial('message/helpSuccess.sms.php') ?></pre>
				<p class="small"> 	
					Legend: [items in square brackets optional]
				</p>
            </li>

	    <li> 
     	For example, if you wanted to receive a listing of all the sites that 
		are defined for your phone number. Send <code>list sites</code> 
		to <code>+1 310 651 0892</code>. The commands are defined below.
		</li>
        </ol>
    </div>
    
    <div class="column last span-10 prepend-1">
    	<h3>Phone with MMS or Email</h3>
		<p>Follow the instructions below in order to submit an observation using email or MMS from your phone.</p>
        <ol>
            <li>Add <code> networkednaturalist@gmail.com </code> to your Contacts</li>
            <li>Follow the instructions for an SMS message</li>
		    <li>Attach an image if desired</li>
		    <li>All commands go in the body of the message. The subject field is ignored</li>
		    <li>Send the message to <code> networkednaturalist@gmail.com</code></li>
	  	</ol>
        <span class="note small">Currently, MMS to a phone number is unsupported.</span>
        
        <hr class="space" />
        <hr />
        
    	<h3>Email from a Computer</h3>
        <p>
			Follow the instructions above for email from a phone. 
        </p>
    </div>
</div>

<h2> Explanation of commands </h2>

<strong> help </strong>
<p>
	Will return the Usage message. 
</p>

<strong> list plants </strong>
<p>
	Will return a list of the plants you are monitoring. Each item in the list
	will have the <em>plant-id</em> and the <em>nickname (nick) </em> for your 
	plant. 
</p>

<strong> list stages plant-id/nick </strong>
<p>
	Will return a list of all possible stages for a specific plant. The plant is
	identified by its <em> plant-id </em> or its nickname <em> nick </em>. 
	Each item in the list will contain the <em> stage-id </em> and the name
	of the stage. 
</p>

<strong> update plant-id/nick stage-id [comment] [attach image] </strong>
<p>
	Will add a new observation for the plant specified by <em> plant-id </em> 
	or its nickname <em> nick </em>. The stage is specified by the numeric
	<em> stage-id </em>. A comment can follow

	<em>update</em> messages will be directly attached to an observation on 
	the site. 

	<br> <br>
	With the command be: <em> update pea 20 This is an example </em>
	<br> We are updating the plant <em> pea </em> to be at stage 
	<em> 20 </em>, and adding the comment <em> This is an example </em>. You 
	can attach an image to this message, and it will be added to your 
	observation.
	</br>
</p>

<strong> note "your note" [attach image] </strong>
<p>
	Use the <em> note </em> command on your phone to upload an image or text
	without updating a specific plant. This information can be accessed at 
	the <em> Notes to Add </em> link. Each uploaded item will be listed in 
	a table called <em> Unresolved Text Messages </em>.
	Click <em> Mark as Read </em> to move notes from the <em> Unresolved Text
	Messages </em> to the <em> Resolved Text Messages </em> table. 

	<em>note</em> messages are simply recorded as reminders for your 
	convenience. Because notes are not associated with a specific plant, you 
	will still need to log in to the site and manually update your plant with 
	the observation recorded in the note. 

    <strong> Associate an image/text from your phone to an observation at a later date </strong>
		<p>
		You can associate the image or text from a note with a specific 
		observation by clicking <em> Make an observation </em> in the desired 
		row in the table of notes. This will 
		take you to a page with your note visible at the top, and a list of 
		your plants visible at the bottom. Click <em> Report an observation 
		</em> next to the plant you want to update. Here, you can click 
		<em> add image </em> on the desired row to update that plant with your 
		image; or create a new observation that can then be updated with the 
		image or text from your note.
		</p>

<?php //$this->load->view('partials/sms_demo.tpl.php');
