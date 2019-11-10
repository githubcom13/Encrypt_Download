[![phpBB](https://www.phpbb-es.com/foro/styles/flat-style/theme/images/logo_new_small.png)](https://www.phpbb-es.com/foro/viewtopic.php?f=147&t=43232)
# [3.2][Ext][1.0.1] Encrypt Download
This extension allows you to encrypt the URL of an external download link and allows its use based on the permissions established for Forums.
Encrypted links are property of the Forum domain and cannot be used in a different domain.
Encrypted links in a Forum can only be decrypted in that same Forum.

## Requirements
* phpBB >= 3.2.4
* PHP >= 5.6

## Install
1. Download the latest release.
2. In the `ext` directory of your phpBB board, copy the `pikaron/encryptdownload` folder. It must be so: `/ext/pikaron/encryptdownload`
4. Navigate in the ACP to `Customise -> Manage extensions`.
5. Look for `Encrypt Download` under the Disabled Extensions list, and click its `Enable` link.

## Uninstall
1. Navigate in the ACP to `Customise -> Extension Management -> Extensions`.
2. Look for `Encrypt Download` under the Enabled Extensions list, and click its `Disable` link.
3. To permanently uninstall, click `Delete Data` and then delete the `/ext/pikaron/encryptdownload` folder.

## License
[GNU General Public License v2](http://opensource.org/licenses/GPL-2.0)