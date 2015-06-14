.. include:: ../Includes.txt
.. include:: Images.txt

.. _installation:

Installation and Configuration
==============================

.. only:: html

	:ref:`quick` | :ref:`stepbystep` |


.. _quick:

Quick Guide
-----------

- Import extension from TYPO3 Extension Repository (TER)
- Make your extension configuration in the Extension Manager
- Include static template to your main TypoScript template
- Make your configuration in the Constants Editor (e.g. include jQuery or Twitter Bootstrap)
- Add a new page with the Frontend Plugin and make your settings (e.g. for Registration)
- Don't forget to set the startpage in the Content Element (the page where the fe_users should be stored)
- It's recommended to use https on the page with registration form, to secure registration and validation via AJAX
- Done


.. _stepbystep:

Step by Step
------------

Extension Manager Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Images
""""""

|em|

Extension Manager

|emConfiguration|

Extension Manager Configuration

Settings
""""""""

.. t3-field-list-table::
 :header-rows: 1

 - :Property:
      Property
   :Datatype:
      Data Type
   :Description:
      Description
   :Default:
      Default Value

 - :Property:
      disableModule
   :Datatype:
      boolean
   :Description:
      Disable Backend Module: You can deactivate the Backend Module if you don't need it
   :Default:
      0

 - :Property:
      disableLog
   :Datatype:
      boolean
   :Description:
      Disable Log: If you don't want to save each change of an fe_user, you can disable the logfile
   :Default:
      0

Plugin Configuration
^^^^^^^^^^^^^^^^^^^^

Images
""""""

|plugin|

Pagecontent

|plugin2|

Plugin Configuration

Explanation Plugin Settings
"""""""""""""""""""""""""""

.. t3-field-list-table::
 :header-rows: 1

 - :Tab:
      Tab
   :Field:
      Field Name
   :Description:
      Description
   :Default:
      Default Value

 - :Tab:
      Main Settings
   :Field:
      Choose View
   :Description:
      Choose between Registration, Edit, List and Detail. This is the main setting for the output in Frontend.
   :Default:
      [empty]

 - :Tab:
      Registration
   :Field:
      Select Fields for New-Form (empty = all fields)
   :Description:
      Define which fields should be shown in the registration form in Frontend. Empty shows all fields.
   :Default:
      [empty]

 - :Tab:
      Registration
   :Field:
      Select Usergroups for new Users
   :Description:
      Define the usergroup(s) for the new registered user. Alternative define it via TypoScript or let the User decide which group is the right one.
   :Default:
      [empty]

 - :Tab:
      Registration
   :Field:
      Registration must be confirmed from sender
   :Description:
      If you check this field, the user has to confirm his registration with a link in a mail. This Double-Opt-In ensures that the email is correct.
   :Default:
      0

 - :Tab:
      Registration
   :Field:
      Registration must be confirmed from an admin (add one ore more emails)
   :Description:
      Add one ore more emails (one per line) if the admin should confirm the registration. This can be combined with the “User Confirmation” field.
   :Default:
      [empty]

 - :Tab:
      Registration
   :Field:
      Notify admin on registration (add one or more emails)
   :Description:
      Notify one or more email receivers (one per line) if a new user was completely registered
   :Default:
      [empty]

 - :Tab:
      Edit
   :Field:
      Select Fields for Edit-Form (empty = all fields)
   :Description:
      Define which fields should be shown in the profile-update-form in Frontend. Empty shows all fields.
   :Default:
      [empty]

 - :Tab:
      Edit
   :Field:
      Show Delete Button in Edit Form
   :Description:
      Renders a delete-Profile-Button in Edit view if checked.
   :Default:
      0

 - :Tab:
      Edit
   :Field:
      Profile update must be confirmed from an admin (add one ore more emails)
   :Description:
      Add one ore more emails (one per line) if the admin should confirm the profile-update.
   :Default:
      [empty]

 - :Tab:
      Edit
   :Field:
      Notify admin on Profile update (add one ore more emails)
   :Description:
      Add one ore more emails (one per line) if the admin should be informed on a profile-update.
   :Default:
      [empty]

 - :Tab:
      Listview
   :Field:
      Show Searchfield
   :Description:
      Displays a Search in Frontend
   :Default:
      0

 - :Tab:
      Listview
   :Field:
      Limit
   :Description:
      Set a maximum limit for the FE-List
   :Default:
      [empty]

 - :Tab:
      Listview
   :Field:
      Order by
   :Description:
      Order by a fe_users field
   :Default:
      Lastname

 - :Tab:
      Listview
   :Field:
      Sorting
   :Description:
      Order Ascending or Descending
   :Default:
      Ascending

 - :Tab:
      Listview
   :Field:
      Show from usergroup (empty = show all)
   :Description:
      Filter List by one or more Usergroups
   :Default:
      [empty]

 - :Tab:
      Detailview
   :Field:
      User to show
   :Description:
      Select one user for the Detailview. This can be left empty if this view is only visited from listview.
   :Default:
      [empty]

 - :Tab:
      Invitation
   :Field:
      Restrict "Add Invitation" to one or more Usergroups (empty = No Restriction)
   :Description:
      Restrict invitation form to a usergroup. Only users of this groups can invite new users (maybe an admin usergroup).
   :Default:
      [empty]

 - :Tab:
      Invitation
   :Field:
      Select Fields for invitation-Form (empty = all fields)
   :Description:
      Define which fields should be shown in the invitation form in Frontend. Empty shows all fields.
   :Default:
      [empty]

 - :Tab:
      Invitation
   :Field:
      Select Usergroups for new Users
   :Description:
      Define the usergroup(s) for the new registered user. Alternative define it via TypoScript or let the User decide which group is the right one.
   :Default:
      [empty]

 - :Tab:
      Invitation
   :Field:
      Notify admin on step 1 (add one ore more emails)
   :Description:
      Add one ore more emails (one per line) if the admin should be informed on a user creation in step 1.
   :Default:
      [empty]

 - :Tab:
      Invitation
   :Field:
      Notify admin if user sets a password (add one ore more emails)
   :Description:
      Add one ore more emails (one per line) if the admin should be informed on a user creation in step 2 (password set by user).
   :Default:
      [empty]

FE Users Record
^^^^^^^^^^^^^^^

Images
""""""

|feusersRecord|

fe_users Record

New Fields in FE-Users Records
""""""""""""""""""""""""""""""

.. t3-field-list-table::
 :header-rows: 1

 - :Tab:
      Tab
   :Field:
      Field Name
   :Description:
      Description
   :Default:
      Default Value

 - :Tab:
      Registration
   :Field:
      Creation Time
   :Description:
      Date and Time when this profile was created.
   :Default:
      0

 - :Tab:
      Registration
   :Field:
      Last profile change at
   :Description:
      Date and Time when this profile was changed at the last time.
   :Default:
      0

 - :Tab:
      Registration
   :Field:
      Registration confirmed by user
   :Description:
      Was this profile confirmed by the user?
   :Default:
      0

 - :Tab:
      Registration
   :Field:
      Registration confirmed by admin
   :Description:
      Was this profile confirmed by the admin?
   :Default:
      0

 - :Tab:
      Registration
   :Field:
      FE_user Log
   :Description:
      Logs every femanager-change on this profile
   :Default:
      [empty]

 - :Tab:
      Registration
   :Field:
      Change Request
   :Description:
      This field is needed, if the admin has to confirm a profile update. All fields that should be updated will be stored with an XML in this field.
   :Default:
      [empty]


TypoScript Configuration
^^^^^^^^^^^^^^^^^^^^^^^^

Images
""""""

|constants|

Constants Editor

Constants
"""""""""

You always find this constants in the file EXT:femanager/Configuration/TypoScript/Main/constants.txt

Constants can be easily changed with the Template Backend-Module (Constants Editor)

There are only a couple of constants in femanager. This is only for the main settings. Please have a look into the TypoScript Setup, if you want to configure more stuff.

Plain Text
""""""""""

.. code-block:: text

	plugin.tx_femanager {
		view {
			# cat=plugin.tx_femanager/file; type=string; label= Path to template root (FE)
			templateRootPath = EXT:femanager/Resources/Private/Templates/

			# cat=plugin.tx_femanager/file; type=string; label= Path to template partials (FE)
			partialRootPath = EXT:femanager/Resources/Private/Partials/

			# cat=plugin.tx_femanager/file; type=string; label= Path to template layouts (FE)
			layoutRootPath = EXT:femanager/Resources/Private/Layouts/
		}
		persistence {
			# cat=plugin.tx_femanager//a; type=int+; label= Default storage PID
			storagePid =
		}
		settings {
			# cat=plugin.tx_femanager//0100; type=text; label= Admin Name: Default admin name for all emails to the user
			adminName = Femanager

			# cat=plugin.tx_femanager//0101; type=text; label= Admin Email: Default admin email for all emails to the user
			adminEmail = Femanager@domain.org

			# cat=plugin.tx_femanager//0900; type=boolean; label= Include jQuery: Load and implement jQuery from external source (googleapis.com)
			jQuery = 0

			# cat=plugin.tx_femanager//0910; type=boolean; label= Include Twitter Bootstrap JS: Load and implement Twitter Bootstrap JavaScript from external source (bootstrapcdn.com)
			bootstrap = 0

			# cat=plugin.tx_femanager//0920; type=boolean; label= Include Twitter Bootstrap CSS: Load and implement Twitter Bootstrap CSS from external source (bootstrapcdn.com)
			bootstrapCSS = 0

			# cat=plugin.tx_femanager//0930; type=boolean; label= Include Fineuploader JS: Load and implement Fineuploader JavaScript from internal source
			fineuploader = 1
		}
	}


Table
"""""

Property prefix is plugin.tx_femanager.

.. t3-field-list-table::
 :header-rows: 1

 - :Property:
      Property
   :Datatype:
      Data Type
   :Description:
      Description
   :Default:
      Default Value

 - :Property:
      view.templateRootPath
   :Datatype:
      string
   :Description:
      Path to template root (FE)
   :Default:
      EXT:femanager/Resources/Private/Templates/

 - :Property:
      view.partialRootPath
   :Datatype:
      string
   :Description:
      Path to template partials (FE)
   :Default:
      EXT:femanager/Resources/Private/Partials/

 - :Property:
      view.layoutRootPath
   :Datatype:
      string
   :Description:
      Path to template layouts (FE)
   :Default:
      EXT:femanager/Resources/Private/Layouts/

 - :Property:
      persistence.storagePid
   :Datatype:
      int
   :Description:
      Default storage PID - can also be set per Plugin
   :Default:
      [empty]

 - :Property:
      settings.adminName
   :Datatype:
      string
   :Description:
      Admin Name: Default admin name for all emails to the user
   :Default:
      Femanager

 - :Property:
      settings.adminEmail
   :Datatype:
      string
   :Description:
      Admin Email: Default admin email for all emails to the user
   :Default:
      Femanager@domain.org

 - :Property:
      settings.jQuery
   :Datatype:
      boolean
   :Description:
      Load and implement jQuery from external source (googleapis.com)
   :Default:
      0

 - :Property:
      settings.bootstrap
   :Datatype:
      boolean
   :Description:
      Include Twitter Bootstrap JS: Load and implement Twitter Bootstrap JavaScript from external source (bootstrapcdn.com)
   :Default:
      0

 - :Property:
      settings.bootstrapCSS
   :Datatype:
      boolean
   :Description:
      Include Twitter Bootstrap CSS: Load and implement Twitter Bootstrap CSS from external source (bootstrapcdn.com)
   :Default:
      0

 - :Property:
      settings.fineuploader
   :Datatype:
      boolean
   :Description:
      Include Fineuploader JS: Load and implement Fineuploader JavaScript from internal source
   :Default:
      1

Setup
"""""

You always find this TypoScript in the file EXT:femanager/Configuration/TypoScript/Main/setup.txt

With TypoScript, you are able to:

- Configure Clientside and Serverside Validation
- Overwrite any Mail setting
- Prefill Formfields
- Save the values to another table (e.g. tt_address)
- Send values to a third-party-software (e.g. a CRM like salesforce)
- And much more...

All settings can be configured directly with TypoScript Setup. Please see all possibilities below:

Plain Text
""""""""""

.. code-block:: text

    plugin.tx_femanager {
        view {
            templateRootPath = {$plugin.tx_femanager.view.templateRootPath}
            partialRootPath = {$plugin.tx_femanager.view.partialRootPath}
            layoutRootPath = {$plugin.tx_femanager.view.layoutRootPath}
        }
        persistence {
            storagePid = {$plugin.tx_femanager.persistence.storagePid}
        }
        features {
            rewrittenPropertyMapper = 1
        }

        settings {

            ###################################
            # Settings for CREATE user profiles
            ###################################
            new {
                # take username and copy it to the email field (so email field is not necessary in FE)
    #			fillEmailWithUsername = 1

                # login after profile creation (don't work if admin confirmation is turned on)
                login = 1

                # prefilling (empty) input fields with values from TypoScript
                prefill {
    #				username = TEXT
    #				username.value = ExampleUsername

    #				email = TEXT
    #				email.value = test@in2code.de
                }

                # redirect user (or admin if adminconfirmation) after profile creation (could be a PID, URL or fileadmin-Link)
    #			redirect = TEXT
    #			redirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect user after profile creation request (only if user confirmation is activated) (could be a PID, URL or fileadmin-Link)
    #			requestRedirect = TEXT
    #			requestRedirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect user after user clicks confirmation link in email (only if user confirmation is activated) (could be a PID, URL or fileadmin-Link)
    #			userConfirmationRedirect = TEXT
    #			userConfirmationRedirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect user after user clicks refuse link in confirmation email (only if user confirmation is activated) (could be a PID, URL or fileadmin-Link)
    #			userConfirmationRefusedRedirect = TEXT
    #			userConfirmationRefusedRedirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect admin after admin clicks confirmation link in email (only if admin confirmation is activated) (could be a PID, URL or fileadmin-Link)
    #			adminConfirmationRedirect = TEXT
    #			adminConfirmationRedirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect admin after admin clicks refuse link in email (only if admin confirmation is activated) (could be a PID, URL or fileadmin-Link)
    #			adminConfirmationRefusedRedirect = TEXT
    #			adminConfirmationRefusedRedirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect admin after admin clicks silent-refuse link in email (only if admin confirmation is activated) (could be a PID, URL or fileadmin-Link)
    #			adminConfirmationRefusedSilentRedirect = TEXT
    #			adminConfirmationRefusedSilentRedirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # validation of user input values
                # possible validations for each field are: required, email, min, max, intOnly, lettersOnly, uniqueInPage, uniqueInDb, date, mustInclude(number,letter,special,space), mustNotInclude(number,letter,special,space), inList(1,2,3), captcha, sameAs(password)
                # see manual for an example how to add custom serverside and clientside validation
                validation {
                    # Enable clientside Formvalidation (JavaScript)
                    _enable.client = 1

                    # Enable serverside Formvalidation (PHP)
                    _enable.server = 1

                    username {
                        required = 1
                        uniqueInDb = 1
                        mustNotInclude = special,space
                    }
                    email {
                        required = 1
                        email = 1
                        #uniqueInPage = 1
                    }
                    password {
                        required = 1
                        #min = 10
                        #mustInclude = number,letter,special
                    }
                    password_repeat {
                        required = 1
                        sameAs = password
                    }
                    usergroup {
                        #inList = 1,2,3
                    }
                    captcha {
                        # requires installation of sr_freecap
    #					captcha = 1
                    }
                }


                # All email settings within the creation process
                email {

                    # Email for User confirmation (User must confirm his Email address)
                    createUserConfirmation {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value = {$plugin.tx_femanager.settings.adminEmail}
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailCreateUserConfirmationSubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }

                    # Email for Admin confirmation (Admin must confirm registration in an email)
                    createAdminConfirmation {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailCreateAdminConfirmationSubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
                        embedImage = COA
                        embedImage {
                            10 = IMG_RESOURCE
                            10 {
                                wrap = |,
                                file.import = uploads/pics/
                                file.import.field = image
                                file.import.listNum = 0
                                file.maxW = 120
                                file.maxH = 120
                            }

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
                        }
                    }

                    # Email to user to confirm his new profile (with and without admin confirmation)
                    createUserNotify {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value = {$plugin.tx_femanager.settings.adminEmail}
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailCreateUserNotifySubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }

                    # Email for User notify, if admin refused profile registration
                    createUserNotifyRefused {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value = {$plugin.tx_femanager.settings.adminEmail}
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailCreateUserNotifyRefusedSubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }

                    # Email for Admin notify, if profile registration
                    createAdminNotify {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailCreateNotifySubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
                        embedImage = COA
                        embedImage {
                            10 = IMG_RESOURCE
                            10 {
                                wrap = |,
                                file.import = uploads/pics/
                                file.import.field = image
                                file.import.listNum = 0
                                file.maxW = 120
                                file.maxH = 120
                            }

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
                        }
                    }
                }

                # overwrite any user values with TypoScript
                forceValues {
                    # Overwrite initally (default)
                    beforeAnyConfirmation {
                        # Usergroups can be set with a commaseparated list
    #					usergroup = TEXT
    #					usergroup.value = 2

                        # Set a fix value
    #					email = TEXT
    #					email.value = service@in2code.de
                    }

                    # Overwrite on user confirmation (only if user confirmation was activated)
                    onUserConfirmation {
                        # Usergroups can be set with a commaseparated list
    #					usergroup = TEXT
    #					usergroup.value = 3

                        # Set a fix value
    #					company = TEXT
    #					company.value = in2code.de
                    }

                    # Overwrite on admin confirmation (only if admin confirmation was activated)
                    onAdminConfirmation {
                        # Usergroups can be set with a commaseparated list
    #					usergroup = TEXT
    #					usergroup.value = 4

                        # Set a fix value
    #					www = TEXT
    #					www.value = http://www.in2code.de
                    }
                }

                # Send Form values via POST to another system (e.g. CRM like salesforce or eloqua)
                sendPost {
                    # Activate sendPost (0/1)
                    _enable = TEXT
                    _enable.value = 0

                    # Target URL for POST values (like http://www.target.com/target.php)
                    targetUrl = https://www.salesforce.com/servlet/servlet.WebToLead?encoding=UTF-8
                    #targetUrl = http://eloqua.com/e/f.aspx

                    # build your post datas like &param1=value1&param2=value2
                    data = COA
                    data {
                        10 = TEXT
                        10 {
                            # value from field {username}
                            field = username
                            wrap = &username=|
                        }

                        20 = TEXT
                        20 {
                            # value from field {email}
                            field = email
                            wrap = &email=|
                        }

                        30 = TEXT
                        30 {
                            # value from field {title}
                            field = title
                            wrap = &title=|
                        }
                    }

                    # activate debug mode - shows all configuration from curl settings (needs extension devlog)
                    debug = 0
                }

                # Save user values to one or more other tables (e.g. tt_address or something else)
                #       With .field=[fieldname] you have access to the user object
                #       Possible values are: uid, username, address, city, company, country, email, fax, firstName, lastName, middleName, name, password, telephone, fax, title, www, zip and lastGeneratedUid (to have access to the uid of the last loop in the next loop)
                storeInDatabase {
                    tt_address {
                        _enable = TEXT
                        _enable.value = 0

                        pid = TEXT
                        pid.value = 21

                        name = TEXT
                        name.field = username

                        email = TEXT
                        email.field = email

                        first_name = TEXT
                        first_name.field = firstName

                        last_name = TEXT
                        last_name.field = lastName
                    }
                }

                misc {
                    # Remove Usergroups from Usergroup Selection in Frontend
    #				removeFromUserGroupSelection = 2,3

                    # initially save password as hash (empty, "md5", "sha1")
    #				passwordSave = md5

                    # Configuration for autogenerated Username and Password
                    autogenerate {
                        username {
                            # Length
                            length = 6

                            # Allow uppercase Characters
                            addUpperCase = 0

                            # Allow special Characters
                            addSpecialCharacters = 0
                        }
                        password {
                            # Length
                            length = 10

                            # Allow uppercase Characters
                            addUpperCase = 1

                            # Allow special Characters
                            addSpecialCharacters = 1
                        }
                    }
                }
            }




            ###################################
            # Settings for UPDATE user profiles
            ###################################
            edit {
                # take username and copy it to the email field (so email field is not nessesary in FE)
                #fillEmailWithUsername = 1

                # redirect user (or admin if adminconfirmation) after profile update
    #			redirect = TEXT
    #			redirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect user after profile update request (only if admin confirmation is activated)
    #			requestRedirect = TEXT
    #			requestRedirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # prefilling (empty) input fields with values from TypoScript
                prefill {
    #				username = TEXT
    #				username.value = ExampleUsername

    #				email = TEXT
    #				email.value = test@in2code.de
                }

                # validation of user input values
                # possible validations for each field are: required, email, min, max, intOnly, lettersOnly, uniqueInPage, uniqueInDb, date, mustInclude(number,letter,special,space), mustNotInclude(number,letter,special,space), inList(1,2,3), captcha, sameAs(password)
                validation {
                    # Enable clientside Formvalidation (JavaScript)
                    _enable.client = 1

                    # Enable serverside Formvalidation (PHP)
                    _enable.server = 1

                    username {
                        required = 1
                        mustNotInclude = special,space
                    }
                    email {
                        required = 1
                        email = 1
                    }
                    password {
                        required = 1
                        #min = 10
                        #mustInclude = number,letter,special
                    }
                    password_repeat {
                        required = 1
                        sameAs = password
                    }
                    usergroup {
                        #inList = 1,2,3
                    }
                    captcha {
                        # requires installation of sr_freecap
    #					captcha = 1
                    }
                }

                # All email settings within the update process
                email {

                    # Email for admin if user requests update (only if confirmation by admin is activated)
                    updateRequest {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailUpdateRequestSubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }

                    # Email to user if update request was refused by admin
                    updateRequestRefused {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receiver (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value = {$plugin.tx_femanager.settings.adminEmail}
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailUpdateRequestRefusedSubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5 (from important to not important)
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }

                    # Email for if update request was refused by admin
                    notifyAdmin {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receiver (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailUpdateNotifySubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5 (from important to not important)
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }
                }

                # overwrite any user values with TypoScript
                forceValues {
                    # Overwrite initally (default) - Note: This values will be updated as soon as the admin confirms the request (if admin confirm is activated)
                    beforeAnyConfirmation {
                        # Usergroups can be set with a commaseparated list
    #					usergroup = TEXT
    #					usergroup.value = 2

                        # Set a fix value
    #					email = TEXT
    #					email.value = service@in2code.de
                    }

                    # Overwrite on admin confirmation (only if admin confirmation was activated)
                    onAdminConfirmation {
                        # Usergroups can be set with a commaseparated list
    #					usergroup = TEXT
    #					usergroup.value = 3

                        # Set a fix value
    #					www = TEXT
    #					www.value = http://www.in2code.de
                    }
                }

                misc {
                    # Don't change password if it is empty
                    keepPasswordIfEmpty = 1

                    # Remove Usergroups from Usergroup Selection in Frontend
    #				removeFromUserGroupSelection = 2,3

                    # initially save password as hash (empty, "md5", "sha1")
    #				passwordSave = md5
                }
            }






            ###################################
            # Settings for INVITATION View
            ###################################
            invitation {
                # take username and copy it to the email field (so email field is not nessesary in FE)
                #fillEmailWithUsername = 1

                # redirect admin after step 1
    #			redirectStep1 = TEXT
    #			redirectStep1 {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect user after profile delete (from email)
    #			redirectDelete = TEXT
    #			redirectDelete {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # redirect user after he changed his password
    #			redirectPasswordChanged = TEXT
    #			redirectPasswordChanged {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}

                # validation of user input values
                # possible validations for each field are: required, email, min, max, intOnly, lettersOnly, uniqueInPage, uniqueInDb, date, mustInclude(number,letter,special,space), mustNotInclude(number,letter,special,space), inList(1,2,3), captcha, sameAs(password)
                # Validation for first Step (Create)
                validation {
                    # Enable clientside Formvalidation (JavaScript)
                    _enable.client = 1

                    # Enable serverside Formvalidation (PHP)
                    _enable.server = 1

                    username {
                        required = 1
                        uniqueInDb = 1
                        mustNotInclude = special,space
                    }
                    email {
                        required = 1
                        email = 1
                    }
                    usergroup {
                        #inList = 1,2,3
                    }
                    captcha {
                        # requires installation of sr_freecap
    #					captcha = 1
                    }
                }
                # Validation for second Step (Edit)
                validationEdit {
                    # Enable clientside Formvalidation (JavaScript)
                    _enable.client = 1

                    # Enable serverside Formvalidation (PHP)
                    _enable.server = 1

                    password {
                        required = 1
                        #min = 10
                        #mustInclude = number,letter,special
                    }
                    password_repeat {
                        required = 1
                        sameAs = password
                    }
                }

                # All email settings within the update process
                email {

                    # Email to user for confirmation
                    invitation {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value = {$plugin.tx_femanager.settings.adminEmail}
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailInvitationSubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }

                    # Email for admin if profile added (only if admin notify is activated)
                    invitationAdminNotifyStep1 {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailInvitationAdminNotifiyStep1Subject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }

                    # Email for admin if profile added (only if admin notify is activated)
                    invitationAdminNotify {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailInvitationAdminNotifiySubject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }

                    # Email for admin if user refused profile invitation (only if admin notify on step 1 is activated)
                    invitationRefused {
                        ##########################
                        # Set values (overwrite)
                        ##########################

                        # (de)activate email completely
                        _enable = TEXT
                        _enable.value = 1

                        # Overwrite Receivers (please fill both)
                        receiver {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value = {$plugin.tx_femanager.settings.adminName}
                        }

                        # Overwrite Senders (please fill both)
                        sender {
                            email = TEXT
                            email.value =
                            name = TEXT
                            name.value =
                        }

                        # Overwrite Subject
                        subject = TEXT
                        subject.data = LLL:EXT:femanager/Resources/Private/Language/locallang.xlf:emailInvitationUserRefusedAdminNotifiyStep1Subject

                        # Set CC receivers
                        cc = TEXT
                        cc.value =

                        # Set mail priority from 1 to 5
                        priority = TEXT
                        priority.value =

                        # Add Attachment (separate each with comma)
    #					attachments = COA
    #					attachments {
    #						10 = TEXT
    #						10.value = fileadmin/file.pdf
    #						10.wrap = |,

    #						20 = TEXT
    #						20.value = fileadmin/file2.pdf
    #						20.wrap = |,
    #					}

                        # Add Embed Images (separate each with comma) - can be used in mail with <img src="{embedImages.0}" /> and so on...
    #					embedImage = COA
    #					embedImage {
    #						10 = IMG_RESOURCE
    #						10 {
    #							wrap = |,
    #							file.import = uploads/pics/
    #							file.import.field = image
    #							file.import.listNum = 0
    #							file.maxW = 120
    #							file.maxH = 120
    #						}

    #						20 = TEXT
    #						20.value = fileadmin/image.jpg
    #					}
                    }
                }

                # overwrite any user values with TypoScript
                forceValues {
                    # Overwrite initally (default)
                    beforeAnyConfirmation {
                        # Usergroups can be set with a commaseparated list
    #					usergroup = TEXT
    #					usergroup.value = 2

                        # Set a fix value
    #					email = TEXT
    #					email.value = service@in2code.de
                    }

                    # Overwrite on admin confirmation (only if admin confirmation was activated)
                    onAdminConfirmation {
                        # Usergroups can be set with a commaseparated list
    #					usergroup = TEXT
    #					usergroup.value = 4

                        # Set a fix value
    #					www = TEXT
    #					www.value = http://www.in2code.de
                    }
                }

                misc {
                    # Remove Usergroups from Usergroup Selection in Frontend
    #				removeFromUserGroupSelection = 2,3

                    # initially save password as hash (empty, "md5", "sha1")
    #				passwordSave = md5
                }
            }


            delete {
                # redirect after profile delete
    #			redirect = TEXT
    #			redirect {
    #				typolink {
    #					parameter = 1
    #					returnLast = url
    #					#linkAccessRestrictedPages = 1
    #				}
    #			}
            }

            list {
                filter {
                    searchword {
                        fieldsToSearch = address, city, company, country, email, fax, first_name, image, last_name, middle_name, name, telephone, title, usergroup.title, username, www, zip
                    }
                }
            }

            misc {
                # Number of allowed images to upload
                uploadAmount = 3

                # Maximum size for image upload in bytes
                uploadSize = 25000000

                # Number of allowed images to upload
                uploadFileExtension = jpeg, jpg, gif, png, bmp

                # Width of the rendered image in FE
                renderImageWidth = 250
            }

            # Don't touch this - this is needed to let the plugin know if the main typoscript is included - otherwise an errormessage will be shown in the frontend
            _TypoScriptIncluded = 1
        }
    }




    #########################
    # Inlude JavaScript files
    #########################
    # add jQuery if it was turned on in the constants
    [globalVar = LIT:0 < {$plugin.tx_femanager.settings.jQuery}]
    page.includeJSFooterlibs.femanagerJQuery = //ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js
    page.includeJSFooterlibs.femanagerJQuery.external = 1
    [end]

    # add twitter bootstrap JS if it was turned on in the constants
    [globalVar = LIT:0 < {$plugin.tx_femanager.settings.bootstrap}]
    page.includeJSFooterlibs.femanangerBootstrap = //netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js
    page.includeJSFooterlibs.femanangerBootstrap.external = 1
    [end]

    # add fineuploader JS if it was turned on in the constants
    [globalVar = LIT:0 < {$plugin.tx_femanager.settings.fineuploader}]
    page.includeJSFooterlibs.femanangerFineuploader = EXT:femanager/Resources/Public/JavaScripts/jquery.fineuploader-3.5.0.min.js
    [end]

    #########################
    # Inlude CSS files
    #########################
    # add twitter bootstrap CSS if it was turned on in the constants
    [globalVar = LIT:0 < {$plugin.tx_femanager.settings.bootstrapCSS}]
    page.includeCSS.femanangerBootstrap = //netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.min.css
    page.includeCSS.femanangerBootstrap.external = 1
    [end]

    page {
        includeCSS {
            femanagerMain = EXT:femanager/Resources/Public/Css/Main.css
        }
        includeJSFooter {
            femanagerValidation = EXT:femanager/Resources/Public/JavaScripts/Validation.js
            femanager = EXT:femanager/Resources/Public/JavaScripts/Femanager.js
        }
    }

Backend Module
^^^^^^^^^^^^^^

Images
""""""

|backendmodule|

Backend Module

Explanation
"""""""""""

The Femanager-Backend-Module is only a small module to search for some frontend users via fulltext.

Some AJAX-requests will help you and your editors to delete or hide and unhide users very fast. The edit icons works in the same way as in the list module. The logout icons allows you to logout a currently logged in frontend user.

In addition you can see who's only in this moment (If fe_users session exists and is not older than 2h).