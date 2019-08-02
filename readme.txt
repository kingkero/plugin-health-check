=== Plugin Health Check ===
Contributors: kingkero
Requires at least: 5.2
Tested up to: 5.2.2
Requires PHP: 7.2
Stable tag: 0.0.4
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Adds checks to the Site Health screen to test installed plugins and themes.

== Description ==
This plugin adds additional tests to the Site Health screen.

Right now this only includes whether updates are available or not. Future releases will include options to silence & escalate specific plugin updates as well as multiple more sanity checks for the installed plugins and themes.

== Screenshots ==
1. The tests found updates are available for one theme and two plugins.

== Changelog ==
**0.0.4**:
- UPDATE configuration

**0.0.3**:
- ADD travis support and auto deploy to SVN
- UPDATE readme to show version numbers bold

**0.0.2**:
- REMOVE illuminate/support to satisfy PHP7.0 lint

**0.0.1**:
- initial release