import os,sys
def search(dir,file):
    try:
        for f in os.listdir(dir):
            if os.path.isdir(os.path.join(dir,f)):
                search(os.path.join(dir,f),file)
            else:
                if f.find(file) >= 0:
                    print "Filename: %s ,Path: %s" % (f ,dir)
    except BaseException,e:
        print "except %s" % e
    finally:
           pass

if __name__ == "__main__":
    search(sys.argv[1],sys.argv[2])