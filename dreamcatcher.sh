#!/bin/bash
# Author: David M. /Ketan P.
# 6/06/14
#
# incrontab arguments that can be used
# IN_ACCESS File was accessed (read) (*)
# IN_ATTRIB Metadata changed (permissions, timestamps, extended attributes, etc.) (*)
# IN_CLOSE_WRITE File opened for writing was closed (*)
# IN_CLOSE_NOWRITE File not opened for writing was closed (*)
# IN_CREATE File/directory created in watched directory (*)
# IN_DELETE File/directory deleted from watched directory (*)
# IN_DELETE_SELF Watched file/directory was itself deleted
# IN_MODIFY File was modified (*)
# IN_MOVE_SELF Watched file/directory was itself moved
# IN_MOVED_FROM File moved out of watched directory (*)
# IN_MOVED_TO File moved into watched directory (*)
# IN_OPEN File was opened (*)
#
# $$   dollar sign
# $@   watched filesystem path (see above)
# $#   event-related file name
# $%   event flags (textually)
# $&   event flags (numerically)

# The purpose of this script is to 3 fold:
# 1. Take the photos from photographers which are ftp to this ftp server and distribute
# 2. 1st it will take the photos from /data/incoming and copy to local server for samba users to curate.
# 3. 2nd dirstribution will move into dreamcatcher to be processed. It is a NFS mount.
# 4. Finally create metrics for photo count total and per photographers for reporting purposes.
#
#								#
#------------------------ Define Variables ---------------------#
#								#
TIMELOGGER="/NBA/Scripts/exiflog.sh"
CAMERASTATS="/NBA/Scripts/check_photo_camera_ips"
TIMELOG="/data/log/TimeLog.log"
FILE=$1
PHOTOG=$2
ret=$?

counterlog=/data/log/photocount_dream.log
counter2log=/data/log/photocount_archive.log
count=`cat $counterlog`
count2=`cat $counter2log`

OUT=/data/log/evertz.log
OUT2=/data/log/archive.log

#individual photographer logs
LOG1="/data/log/Butler.log"
LOG2="/data/log/Bernstein.log"
LOG3="/data/log/Garrabrant.log"
LOG4="/data/log/Evans.log"

#inidividual photographer counters
photogcount1=`cat $LOG1`
photogcount2=`cat $LOG2`
photogcount3=`cat $LOG3`
photogcount4=`cat $LOG4`

Butlerdir="/data/incoming/Butler"

#								#
#--------------- output report----------------------------------#
#								#

# count=$photogcount1+$photogcount2+$photogcount3+$photogcount4
if [ "$FILE" = "report" ]; then
echo "#------------ Individual -----------#"
echo "# Butler Count:			$photogcount1"
echo "# Bernstein Count:		$photogcount2"
echo "# Garrabrant Count:		$photogcount3"
echo "# Evans Count:			$photogcount4"
echo "#------------ Total ----------------#"
echo "# Photos Sent to Dreamcatcher:	$count2"
echo "# Photos Sent to photos share:	$count"
echo "#-----------------------------------#"
$CAMERASTATS
exit 99
fi

#								#
#--------------- initial check for counters --------------------#
#								#
# set all counter files to 0 if argument is "clear" ex: ./dreamcatcher.sh clear ( done after every quarter)
if  [[ "$FILE" = "clear" ]]; then 
 echo 0 > $counterlog 
 echo 0 > $counter2log
 echo 0 > $LOG1
 echo 0 > $LOG2
 echo 0 > $LOG3
 echo 0 > $LOG4
 exit 99
fi
#								#
#-------------- MAIN -------------------------------------------#
#								#

#--------------------------------------------------------
echo -e "----------`date`: FILE: $FILE----" | tee -a $OUT $OUT2
# -------------------------------------------------------
# Taking photos from cameras via FTP and updating log file for both evertz and archive files

#------------------ Butler info ------------------------------------------
 if [ "$PHOTOG" = "Butler" ];then
  for subfold in cutout pole glass
   do
     if [ -f $Butlerdir/$subfold/A/DCIM/100EOS1D/$FILE ];then 
      # Call script exiflog.sh to log exif time and file creation time
      $TIMELOGGER $PHOTOG $Butler/$subfold/A/DCIM/100EOS1D/$FILE >> $TIMELOG
 
      # Copy camera photo to Dreamcatcher NFS mount
      cp -v $Butlerdir/$subfold/A/DCIM/100EOS1D/$FILE /dreamcatcher/watch >> $OUT
      ((count++)); echo $count > $counterlog

      # Move the camera photo to Samba share for curators to edit
      mv -v $Butlerdir/$subfold/A/DCIM/100EOS1D/$FILE /data/photos/Butler >> $OUT2 
      
      # Reportig counters
      ((count2++)); echo $count2 > $counter2log
      ((photogcount1++)); echo $photogcount1 > $LOG1

     fi

# ----- Special 1 directory for Handheld being different for Butler
    if [ -f $Butlerdir/handheld/$FILE ]; then
	# Call script exiflog.sh to log exif time and file creation time
        $TIMELOGGER $PHOTOG /data/incoming/Butler/handheld/$FILE >> $TIMELOG

     # Copy camera photo to Dreamcatcher NFS mount
       cp -v $Butlerdir/handheld/$FILE /dreamcatcher/watch | tee -a $OUT
       ((count++)); echo $count > $counterlog
     
     # Move the camera photo to Samba share for curators to edit
       mv -v $Butlerdir/handheld/$FILE /data/photos/Butler | tee -a $OUT2
       ((count2++)); echo $count2 > $counter2log
       ((photogcount1++)); echo $photogcount1 > $LOG1
    fi
   done
 fi

#------------------ Bernstein info --------------------------------------
  if [ "$PHOTOG" = "Bernstein" ]; then
    # Call script exiflog.sh to log exif time and file creation time
    $TIMELOGGER $PHOTOG /data/incoming/$PHOTOG/$FILE >> $TIMELOG

    cp -v /data/incoming/$PHOTOG/$FILE /dreamcatcher/watch  | tee -a $OUT
    ((count++));  echo $count > $counterlog

    mv -v /data/incoming/$PHOTOG/$FILE /data/photos/$PHOTOG | tee -a $OUT2
    ((count2++)); echo $count2 > $counter2log
    ((photogcount2++)); echo $photogcount2 > $LOG2
  fi
#------------------ Garrabrant info -------------------------------------
  if [ "$PHOTOG" = "Garrabrant" ]; then
    # Call script exiflog.sh to log exif time and file creation time
    $TIMELOGGER $PHOTOG /data/incoming/$PHOTOG/$FILE >> $TIMELOG

    cp -v /data/incoming/$PHOTOG/$FILE /dreamcatcher/watch  | tee -a $OUT
    ((count++)); echo $count > $counterlog

    mv -v /data/incoming/$PHOTOG/$FILE /data/photos/$PHOTOG | tee -a $OUT2
    ((count2++)); echo $count2 > $counter2log
    ((photogcount3++)); echo $photogcount3 > $LOG3
  fi
#------------------ Evans info ------------------------------------------
  if [ "$PHOTOG" = "Evans" ]; then
    # Call script exiflog.sh to log exif time and file creation time
    $TIMELOGGER $PHOTOG data/incoming/$PHOTOG/$FILE >> $TIMELOG

    cp -v /data/incoming/$PHOTOG/$FILE /dreamcatcher/watch  | tee -a $OUT
   ((count++)); echo $count > $counterlog

    mv -v /data/incoming/$PHOTOG/$FILE /data/photos/$PHOTOG | tee -a $OUT2
   ((count2++)); echo $count2 > $counter2log
   ((photogcount4++)); echo $photogcount4 > $LOG4
  fi

