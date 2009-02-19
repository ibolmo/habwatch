
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
    
    <div class="column border span-10 append-1 prepend-1">
    	<h3>Phone with MMS or Email</h3>
		<p>Follow the instructions below in order to submit an observation using email or MMS from your phone.</p>
        <ol>
            <li>Add <code><?= sfConfig::get('app_project_participate_email') ?></code> to your Contacts</li>
            <li>Follow the instructions for an SMS message</li>
		    <li>Attach an image if desired</li>
		    <li>All commands go in the body of the message. The subject field is used for tagging. Add tags about the contents, conditions, etc., that would help describe the picture</li>
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
    <div class="column span-24">
        <hr />
        <h3>From a Particular Phone</h3>
        <ul id="buttons" class="tabs"> 
        	<li>iPhone</li> 
        	<li>N95</li>
        	<li>N80 + GPS Module</li> 
        </ul>        
    
        <div id="panes">
            <div>
                <div class="pane">
                    <h4>Apple iPhone</h4>
                    <p>Collecting data (pictures) with an iPhone has the following workflow:</p>

                    <ol>
                        <li>Make sure your iPhone has Location Services '<code>on</code>':
                            <ul><li>Settings > General > Location Services</li></ul>
                        </li>
                        <li>Launch the camera, or equivalent application (assuming they also geocode images), and take a picture.</li>
                        <li>
                            From the camera roll (Home Screen > Photos > Camera Roll) or (Select the gallery button next to the Camera icon to take a picture).
                            <ol>
                                <li>Select the picture you'd like to upload. </li>
                                <li>Select the lower hand icon, for uploads.</li>
                                <li>Follow the <code>Phone with MMS or Email</code> instructions above.</li>
                            </ol>
                        </li>
                        <li><strong>You're done!</strong></li>
                    </ol>
                </div>
                <div class="pane">
                    <h4>Nokia N95</h4>
                    <p>Collecting data (pictures) with an N95 has the following workflow:</p>
                    
                    <ol>
                    <li>Make sure your GPS module is turned on. 
                    <ul><li>Slide the switch from the off position (on the left of the device, <code>VisionTac</code> logo facing you) to the on position</li></ul></li>
                    <li>Run the <code>Location Tagger</code> application. There are two options on how to run this application:
                    <ol>
                        <li>
                            From the pre-defined shortcut key:
                            <ul><li>Use the right shortcut key (it's the blue curved line above the end/red call button)</li></ul>
                        </li>
                    
                    <li>
                        From the menu icon in a couple of places:
                        <ul>
                            <li>First select the Menu, from the Menu button (located to the right of the pencil [the bottom left icon on the phone]), button</li>
                            <li>Inside the Menu, Select "<code>My own</code>" and check if "<code>Location Tagger</code>" is in that directory. If not, continue.</li>
                            <li>Select "<code>back</code>" or hit the Menu Button to go back to the Menu Screen.</li>
                            <li>Select: Tools, and try to locate "<code>Location Tagger</code>" inside. If not found, contact &lt;<me>> for help.</li>
                        </ul>
                    </li>
                    </ol>
                    </li>
                    <li>Wait 5 seconds.</li>
                    <li>We need to check that the GPS module is receiving a satellite signal.
                    <ul><li>The <code>Last Location</code> on the <code>Location Tagger</code> will show a coordinate. For example: <code>34°4'6".239N 118°26'35"</code></li></ul></li>
                    <li>Select <code>Hide</code> and you're set to take pictures.</li>
                    </ol>
                    
                    <h5>Taking a Picture</h5>
                    
                    <ol>
                    <li>On the bottom right (side) of the phone, a silver button is used to launch and is the shutter button for the camera. </li>
                    <li>Locate and hold the camera button for 2 seconds.</li>
                    <li>The camera application should run.</li>
                    <li>The camera settings (select <code>Options</code>) should be set to:
                    <ul><li>Image Sharpness (in <code>Image setup</code>): <code>Hard</code></li>
                    <li>Image Quality (in <code>Settings</code>): <code>E-mail 0.5M</code> (or better)</li></ul></li>
                    <li>When ready, press the camera button to take a picture.</li>
                    <li>If the <code>Location Tagger</code> is running in the background, it will geotag the taken picture (a green icon appears at the top left of the viewport).</li>
                    </ol>
                    
                    <h5>Send an Image via Email</h5>
                    
                    <ol>
                    <li>If you <em>just</em> taken a picture, you'll have an opportunity to select <code>Options</code> and select <code>Send</code> > <code>Via Email</code> (assuming you have the mailbox setup, if you do you'll see the <code>Via Email</code> option). </li>
                    <li>Otherwise, you may go to the <code>Menu</code> screen (see 2.2) and select the <code>Gallery</code> application.</li>
                    <li>In the <code>Gallery</code> application, select <code>Images &amp; Video</code> and find the picture you'd like to upload.</li>
                    <li>Once found, select Options and proceed with 1 in this section.</li>
                    <li>Follow the <code>Phone with MMS or Email</code> instructions above.</li>
                    </ol>

                </div>
                <div class="pane">
                    <h4>Nokia N80 + GPS Module</h4>
                    <p>Collecting data (pictures) with an N80 with a GPS module has the following workflow:</p>
                    
                    <ol>
                    <li>Make sure your GPS module is turned on. 
                    <ul><li>Slide the switch from the off position (on the left of the device, <code>VisionTac</code> logo facing you) to the on position</li></ul></li>
                    <li>Run the <code>Location Tagger</code> application. There are two options on how to run this application:
                    <ol>
                        <li>
                            From the pre-defined shortcut key:
                            <ul><li>Use the right shortcut key (it's the blue curved line above the end/red call button)</li></ul>
                        </li>
                    
                    <li>
                        From the menu icon in a couple of places:
                        <ul>
                            <li>First select the Menu, from the Menu button (located to the right of the pencil [the bottom left icon on the phone]), button</li>
                            <li>Inside the Menu, Select "<code>My own</code>" and check if "<code>Location Tagger</code>" is in that directory. If not, continue.</li>
                            <li>Select "<code>back</code>" or hit the Menu Button to go back to the Menu Screen.</li>
                            <li>Select: Tools, and try to locate "<code>Location Tagger</code>" inside. If not found, contact &lt;<me>> for help.</li>
                        </ul>
                    </li>
                    </ol>
                    
                    </li>
                    <li>Wait 5 seconds.</li>
                    <li>If the phone has paired with the GPS module, the GPS module's blue light will blink slowly. Additionally, the screen of the phone will indicate on the top right a solid <code>(B)</code> icon. </li>
                    <li>If the device has failed to pair with the module do the following:
                    <ol><li>Inside of Location Tagger, select <code>Options</code> and select <code>Exit</code></li>
                    <li>Go to the Menu screen by pressing the Menu key (see 2.2 to locate the Menu Screen)</li>
                    <li>In the Menu Screen, Open the <code>Connect</code> application</li>
                    <li>In the <code>Connect</code> application select <code>Bluetooth</code></li>
                    <li>In <code>Bluetooth</code>, press on the <code>right</code> directional button (the right side of center silver rounded square).</li>
                    <li>This should bring you to the <code>Paired devices</code> screen</li>
                    <li>In the <code>Paired devices</code> screen, select <code>Options</code></li>
                    <li>Select: <code>Delete all</code> and select <code>Yes</code></li>
                    <li>Select: <code>Exit</code> and go back to the Standby Screen by pressing the end call (red) button.</li>
                    <li>Make sure the GPS Module is turned on.</li>
                    <li>Launch Location Tagger</li>
                    <li>Location Tagger will now attempt to find a GPS module. Location Tagger will provide you with a <code>Last devices used</code> or will try to search for a module automatically.</li>
                    <li>If you get the <code>Last devices used</code>, please ignore and just select <code>More devices</code></li>
                    <li>Let the search run until you see something similar to: <code>VGPS-500</code></li>
                    <li>You may select stop after the search finds your device</li>
                    <li>Select the <code>VGPS-500</code> from the list, and it'll ask you for a passcode. Type in: <code>0000</code> as the passcode.</li>
                    <li>After you've added the GPS module, see if the blue (bluetooth) light is now blinking slowly.</li>
                    <li>If you're still having a problem contact &lt;<me>></li></ol></li>
                    <li>Once the GPS is confirmed as having been paired with the device, we need to check that the GPS module is receiving a satellite signal.
                    <ol><li>The green satellite icon should be blinking slowly. If it is, then you are receiving GPS signals. If it's not, you may need to find a better location to read the GPS signals.</li>
                    <li>After confirming that the GPS module's green satellite icon is blinking (or receiving GPS coordinates), check that the <code>Location Tagger</code> is receiving the data. </li>
                    <li>The <code>Last Location</code> on the <code>Location Tagger</code> will show a coordinate. For example: <code>34°4'6".239N 118°26'35"</code></li></ol></li>
                    <li>We're almost done!</li>
                    <li>Select <code>Hide</code> and you're set to take pictures.</li>
                    </ol>
                    
                    <h5>Taking a Picture</h5>
                    
                    <ol>
                    <li>On the bottom right (side) of the phone, a silver button is used to launch and is the shutter button for the camera. </li>
                    <li>Locate and hold the camera button for 2 seconds.</li>
                    <li>The camera application should run.</li>
                    <li>The camera settings (select <code>Options</code>) should be set to:
                    <ul><li>Image Sharpness (in <code>Image setup</code>): <code>Hard</code></li>
                    <li>Image Quality (in <code>Settings</code>): <code>E-mail 0.5M</code> (or better)</li></ul></li>
                    <li>When ready, press the camera button to take a picture.</li>
                    <li>If the <code>Location Tagger</code> is running in the background, it will geotag the taken picture (a green icon appears at the top left of the viewport).</li>
                    </ol>
                    
                    <h5>Send an Image via Email</h5>
                    
                    <ol>
                    <li>If you <em>just</em> taken a picture, you'll have an opportunity to select <code>Options</code> and select <code>Send</code> > <code>Via Email</code> (assuming you have the mailbox setup, if you do you'll see the <code>Via Email</code> option). </li>
                    <li>Otherwise, you may go to the <code>Menu</code> screen (see 2.2) and select the <code>Gallery</code> application.</li>
                    <li>In the <code>Gallery</code> application, select <code>Images &amp; Video</code> and find the picture you'd like to upload.</li>
                    <li>Once found, select Options and proceed with 1 in this section.</li>
                    <li>Follow the <code>Phone with MMS or Email</code> instructions above.</li>
                    </ol>

                </div>
            </div>
        </div>
    </div>
</div>
