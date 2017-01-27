Known Issues with Outlook Add-in
=================================

Issue: Synchronization of Microsoft Outlook and OroCRM Fails
------------------------------------------------------------------

1. The MS Outlook Add-in is installed.
2. The connection check shows that the connection is successful. 
3. The error message on unsuccessful synchronization is similar to the following:

   *Unable to cast COM object of type 'Microsoft.Office.Interop.Outlook.ApplicationClass' to interface type 'Microsoft.Office.Interop.Outlook._Application'. This operation failed because the QueryInterface call on the COM component for the interface with IID '{00063001-0000-0000-C000-000000000046}' failed due to the following error: Error loading type library/DLL. (Exception from HRESULT: 0x80029C4A (TYPE_E_CANTLOADLIBRARY)).*

Cause
^^^^^^
This issue sometimes arises when you uninstall the higher version of the Microsoft Outlook / Microsoft Office and return to the earlier version. Some registry keys may not be removed as expected during uninstall resulting in Outlook using invalid data to load.  

Solution
^^^^^^^^^
One of the possible solutions is to clean up the system registry and remove invalid register keys. Close your Microsoft applications and follow these instructions: 

https://www.fieldstonsoftware.com/support/support_gsyncit_8002801D.shtml

If the issue persists, try to reinstall Microsoft Outlook.  
