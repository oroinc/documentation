Email Ownership
===============

Email ownership differs from the standard model slightly. The emailUser relation is used to determine permissions for the email object.
In such a way, several users can be owners of one email object. For example, when two users synchronize email conversation at the same time via IMAP, one email object is created, and two relations with appropriate users. For each user, an appropriate access permission is applied to the same email via the userEmail relation.