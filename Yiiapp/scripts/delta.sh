#!/bin/sh
/usr/local/bin/indexer delta --rotate
/usr/local/bin/indexer --merge rents delta --rotate 