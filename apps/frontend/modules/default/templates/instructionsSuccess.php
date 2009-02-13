
<h4>Here are some instructions to get started with <?= sfConfig::get('app_project_name') ?>!</h4>	

<div class="block">
	<div class="column border span-10 append-1 prepend-1">
        <h3>Phone with SMS</h3>
        <ol>
            <li>Add <code>+1 310 848 7807</code> to your Contacts</li>
            <li>
                For SMS to function correctly you must abide by the following syntax:
                <pre><?= include_partial('message/help') ?></pre>
				<p class="small"> 	
					Legend: [items in square brackets optional]
				</p>
            </li>
        </ol>
	    <p> 
         	For example,
         	<blockquote><code>report hurt dolphin santa monica pier</code></blockquote>
		</p>
    </div>
    
    <div class="column last span-10 prepend-1">
    	<h3>Phone with MMS or Email</h3>
		<p>Follow the instructions below in order to submit an observation using email or MMS from your phone.</p>
        <ol>
            <li>Add <code><?= sfConfig::get('app_project_participate_email') ?></code> to your Contacts</li>
            <li>Follow the instructions for an SMS message</li>
		    <li>Attach an image if desired</li>
		    <li>All commands go in the body of the message. The subject field is ignored</li>
		    <li>Send the message to <code><?= sfConfig::get('app_project_participate_email') ?></code></li>
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
