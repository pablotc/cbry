#!/usr/bin/perl
use strict;
use CGI;
my %conf;
my $query = new CGI;
my $addr = $ENV{'REMOTE_ADDR'};
my $filename = $query->param('filename');
print "content-type: text/html\n\n";
my $cmd = './tbk_check_mac.cgi log/'.$filename;
exec($cmd);